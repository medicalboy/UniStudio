<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Create Note</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/upload.css') ?>"
    >

</head>


<body>


<section class="upload-hero">

    <div class="container">

        <div class="row align-items-center">


            <div class="col-lg-7">

                <span class="upload-label">
                    Community
                </span>

                <h1>
                    Create a Note
                </h1>

                <p>
                    Share something with the UniStudio community.
                </p>

            </div>


            <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">

                <a
                    href="<?= base_url('welcome') ?>"
                    class="btn btn-outline-dark"
                >
                    Back to home
                </a>

            </div>


        </div>

    </div>

</section>



<section class="upload-section">

    <div class="container">


        <?php if (!empty($error)): ?>

            <div class="alert alert-danger">

                <?= $error ?>

            </div>

        <?php endif; ?>



        <form id="uploadForm">


            <div class="row g-4">


                <div class="col-lg-8">


                    <div class="upload-card">


                        <div class="upload-card-header">

                            <h3>
                                Note information
                            </h3>

                            <p>
                                Add a title, description and media.
                            </p>

                        </div>



                        <div class="upload-card-body">


                            <!-- TITLE -->

                            <div class="mb-4">

                                <label
                                    for="subject"
                                    class="form-label"
                                >
                                    Note title
                                </label>


                                <input
                                    type="text"
                                    name="subject"
                                    id="subject"
                                    class="form-control form-control-lg"
                                    placeholder="Give your Note a title"
                                    required
                                >

                            </div>



                            <!-- DESCRIPTION -->

                            <div class="mb-4">

                                <label
                                    for="description"
                                    class="form-label"
                                >
                                    Description
                                </label>


                                <textarea
                                    name="description"
                                    id="description"
                                    class="form-control"
                                    rows="6"
                                    placeholder="Write something..."
                                    required
                                ></textarea>

                            </div>



                            <!-- MEDIA -->

                            <div class="mb-4">

                                <label class="form-label">
                                    Photo or video
                                </label>


                                <label
                                    for="userfile"
                                    class="upload-drop-zone"
                                >

                                    <div class="upload-icon">
                                        ↑
                                    </div>


                                    <h5>
                                        Upload an image or video
                                    </h5>


                                    <p>
                                        Click here to choose a file
                                    </p>


                                    <span>
                                        JPG, JPEG, PNG or MP4
                                    </span>

                                </label>


                                <input
                                    type="file"
                                    name="userfile"
                                    id="userfile"
                                    class="d-none"
                                    accept=".jpg,.jpeg,.png,.webp,.heic,.heif,.mp4,.mov,.m4v"
                                    required
                                >


                                <div
                                    id="selected-file"
                                    class="selected-file"
                                >
                                    No file selected
                                </div>

                            </div>


                        </div>


                    </div>



                    <!-- PUBLISH -->

                    <div class="publish-card">

                        <div>

                            <h5>
                                Ready to share?
                            </h5>

                            <p>
                                Your Note will be shared with
                                the UniStudio community.
                            </p>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-dark btn-lg"
                        >
                            Publish Note
                        </button>

                    </div>


                </div>



                <!-- RIGHT SIDE -->

                <div class="col-lg-4">


                    <div class="upload-side-card">

                        <h4>
                            Create your Note
                        </h4>


                        <div class="guideline-item">

                            <div class="guideline-number">
                                1
                            </div>

                            <div>

                                <strong>
                                    Add a title
                                </strong>

                                <p>
                                    Give your Note a clear title.
                                </p>

                            </div>

                        </div>



                        <div class="guideline-item">

                            <div class="guideline-number">
                                2
                            </div>

                            <div>

                                <strong>
                                    Upload media
                                </strong>

                                <p>
                                    Add an image or video.
                                </p>

                            </div>

                        </div>



                        <div class="guideline-item">

                            <div class="guideline-number">
                                3
                            </div>

                            <div>

                                <strong>
                                    Share
                                </strong>

                                <p>
                                    Publish your Note to the community.
                                </p>

                            </div>

                        </div>


                    </div>


                </div>


            </div>


        </form>


    </div>

</section>



<script>


// Show selected filename

document
    .getElementById('userfile')
    .addEventListener('change', function () {

        const fileName =
            this.files.length > 0
                ? this.files[0].name
                : 'No file selected';


        document
            .getElementById('selected-file')
            .textContent = fileName;

    });



document
    .getElementById('uploadForm')
    .addEventListener('submit', async function (event) {


        event.preventDefault();



        const fileInput =
            document.getElementById('userfile');


        const file =
            fileInput.files[0];


        const subject =
            document
                .getElementById('subject')
                .value;


        const description =
            document
                .getElementById('description')
                .value;



        if (!file) {

            alert('Please choose a file');

            return;

        }



        try {


            // ==========================================
            // STEP 1
            // Get S3 upload URL
            // ==========================================

            const presignData =
                new FormData();


            presignData.append(
                'filename',
                file.name
            );


            presignData.append(
                'file_type',
                file.type
            );



            const presignResponse =
                await fetch(

                    '<?= base_url('upload/presign') ?>',

                    {
                        method: 'POST',
                        body: presignData
                    }

                );



            if (!presignResponse.ok) {

                const errorMessage =
                    await presignResponse.text();

                throw new Error(
                    errorMessage
                );

            }



            const presignResult =
                await presignResponse.json();



            // ==========================================
            // STEP 2
            // Upload directly to S3
            // ==========================================

            const s3Response =
                await fetch(

                    presignResult.upload_url,

                    {

                        method: 'PUT',

                        headers: {

                            'Content-Type':
                                file.type

                        },

                        body: file

                    }

                );



            if (!s3Response.ok) {

                throw new Error(
                    'S3 upload failed'
                );

            }



            // ==========================================
            // STEP 3
            // Save Note information
            // ==========================================

            const noteData =
                new FormData();


            noteData.append(
                'subject',
                subject
            );


            noteData.append(
                'description',
                description
            );


            noteData.append(
                'filename',
                presignResult.key
            );


            noteData.append(
                'file_type',
                file.type
            );



            const saveResponse =
                await fetch(

                    '<?= base_url('upload/save_note') ?>',

                    {

                        method: 'POST',

                        body: noteData

                    }

                );



            if (!saveResponse.ok) {

                throw new Error(
                    'Could not save Note'
                );

            }



            // ==========================================
            // SUCCESS
            // ==========================================

            window.location.href =
                '<?= base_url('welcome') ?>';



        } catch (error) {


            console.error(error);


            alert(
                error.message
            );


        }


    });


</script>


</body>

</html>