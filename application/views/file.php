<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Upload Product</title>

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
                    Seller Centre
                </span>

                <h1>
                    Upload a new product
                </h1>

                <p>
                    Add your product information, upload a clear image or video,
                    and publish it to your UniStudio channel.
                </p>
            </div>

            <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">

                <a
                    href="<?= base_url('uploader_channel') ?>"
                    class="btn btn-outline-dark">
                    Back to your channel
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

            <!-- LEFT -->
            <div class="col-lg-8">

                <div class="upload-card">

                    <div class="upload-card-header">

                        <h3>
                            Product information
                        </h3>

                        <p>
                            Tell customers what you are uploading.
                        </p>

                    </div>


                    <div class="upload-card-body">

                        <!-- SUBJECT -->
                        <div class="mb-4">

                            <label
                                for="subject"
                                class="form-label">
                                Product title
                            </label>

                            <input
                                type="text"
                                name="subject"
                                id="subject"
                                class="form-control form-control-lg"
                                placeholder="e.g. Nike Running Shoes"
                                required
                            >

                            <div class="form-text">
                                Use a short and clear product name.
                            </div>

                        </div>


                        <!-- DESCRIPTION -->
                        <div class="mb-4">

                            <label
                                for="description"
                                class="form-label">
                                Product description
                            </label>

                            <textarea
                                name="description"
                                id="description"
                                class="form-control"
                                rows="5"
                                placeholder="Describe the product, course or resource..."
                                required
                            ></textarea>

                            <div class="form-text">
                                Explain what the product is and why it is useful.
                            </div>

                        </div>


                        <!-- FILE -->
                        <div class="mb-4">

                            <label class="form-label">
                                Product media
                            </label>

                            <label
                                for="userfile"
                                class="upload-drop-zone">

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
                                accept=".jpg,.jpeg,.png,.mp4"
                                required
                            >

                            <div
                                id="selected-file"
                                class="selected-file">
                                No file selected
                            </div>

                        </div>

                    </div>

                </div>


                <!-- PUBLISH -->
                <div class="publish-card">

                    <div>

                        <h5>
                            Ready to publish?
                        </h5>

                        <p>
                            Your product will appear in the marketplace
                            and on your personal channel.
                        </p>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-dark btn-lg">
                        Publish product
                    </button>

                </div>

            </div>


            <!-- RIGHT -->
            <div class="col-lg-4">

                <div class="upload-side-card">

                    <h4>
                        Upload guidelines
                    </h4>

                    <div class="guideline-item">

                        <div class="guideline-number">
                            1
                        </div>

                        <div>
                            <strong>Use a clear title</strong>

                            <p>
                                Keep the product title simple and easy to understand.
                            </p>
                        </div>

                    </div>


                    <div class="guideline-item">

                        <div class="guideline-number">
                            2
                        </div>

                        <div>
                            <strong>Use a quality image</strong>

                            <p>
                                Product images should be clear and easy to recognise.
                            </p>
                        </div>

                    </div>


                    <div class="guideline-item">

                        <div class="guideline-number">
                            3
                        </div>

                        <div>
                            <strong>Write a useful description</strong>

                            <p>
                                Tell customers what they should know before viewing.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="upload-side-card mt-4">

                    <h5>
                        Your product will appear in
                    </h5>

                    <ul class="publish-list">
                        <li>Marketplace</li>
                        <li>Your personal channel</li>
                        <li>Product search results</li>
                    </ul>

                </div>

            </div>

        </div>
        </form>
    </div>

</section>


<script>
document
    .getElementById('uploadForm')
    .addEventListener('submit', async function (event) {

        // Stop normal HTML form submission
        event.preventDefault();

        const fileInput =
            document.getElementById('userfile');

        const file = fileInput.files[0];

        const subject =
            document.getElementById('subject').value;

        const description =
            document.getElementById('description').value;

        if (!file) {
            alert('Please choose a file');
            return;
        }

        try {

            // ---------------------------------
            // STEP 1
            // Ask CodeIgniter for S3 upload URL
            // ---------------------------------

            const presignData = new FormData();

            presignData.append(
                'filename',
                file.name
            );

            presignData.append(
                'file_type',
                file.type
            );

            const presignResponse = await fetch(
                '<?= base_url('upload/presign') ?>',
                {
                    method: 'POST',
                    body: presignData
                }
            );

            if (!presignResponse.ok) {
                throw new Error(
                    'Could not create upload URL'
                );
            }

            const presignResult =
                await presignResponse.json();

            // ---------------------------------
            // STEP 2
            // Upload file DIRECTLY to S3
            // ---------------------------------

            const s3Response = await fetch(
                presignResult.upload_url,
                {
                    method: 'PUT',

                    headers: {
                        'Content-Type': file.type
                    },

                    body: file
                }
            );

            if (!s3Response.ok) {
                throw new Error(
                    'S3 upload failed'
                );
            }

            // ---------------------------------
            // STEP 3
            // Save product information in RDS
            // ---------------------------------

            const productData = new FormData();

            productData.append(
                'subject',
                subject
            );

            productData.append(
                'description',
                description
            );

            productData.append(
                'filename',
                presignResult.key
            );

            productData.append(
                'file_type',
                file.type
            );

            const saveResponse = await fetch(
                '<?= base_url('upload/save_product') ?>',
                {
                    method: 'POST',
                    body: productData
                }
            );

            if (!saveResponse.ok) {
                throw new Error(
                    'Could not save product'
                );
            }

            // Success
            window.location.href =
                '<?= base_url('welcome') ?>';

        } catch (error) {

            console.error(error);

            alert(error.message);
        }
    });
</script>

</body>
</html>