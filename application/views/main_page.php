<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>UniStudio</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/products.css') ?>"
    >

</head>


<body>


<!-- =====================================================
     INTRODUCTION
===================================================== -->

<section class="hero-section">

    <div class="container">

        <div class="row align-items-center">


            <div class="col-lg-7">

                <span class="hero-label">
                    UniStudio Community
                </span>


                <h1 class="hero-title">
                    Share your content.
                    Sell your products.
                </h1>


                <p class="hero-text">

                    UniStudio is a community where you can
                    share content with others and publish
                    products for people to discover and buy.

                </p>


                <!-- TWO MAIN ACTIONS -->

                <div class="hero-actions">

                    <a
                        href="<?= base_url('upload/note') ?>"
                        class="btn btn-dark btn-lg"
                    >
                        Create Note
                    </a>


                    <a
                        href="<?= base_url('upload') ?>"
                        class="btn btn-outline-dark btn-lg"
                    >
                        Publish a Product
                    </a>

                </div>

            </div>


            <!-- RIGHT SIDE -->

            <div class="col-lg-5 mt-4 mt-lg-0">

                <div class="hero-card">

                    <div class="hero-card-small">
                        UniStudio
                    </div>


                    <h3>
                        Share and discover
                    </h3>


                    <p>
                        Connect with the community through Notes,
                        or visit the Market to discover products.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>



<!-- =====================================================
     NOTES
===================================================== -->

<section class="products-section">

    <div class="container">


        <!-- SECTION TITLE -->

        <div class="section-header">

            <div>

                <span class="section-label">
                    Community
                </span>


                <h2>
                    Explore Notes
                </h2>


                <p>
                    See what people are sharing on UniStudio.
                </p>

            </div>

        </div>



        <!-- NOTES LIST -->

        <?php if (!empty($files)): ?>


            <div
                class="row
                       row-cols-1
                       row-cols-sm-2
                       row-cols-md-3
                       row-cols-lg-4
                       row-cols-xl-5
                       g-4"
            >


                <?php foreach ($files as $file): ?>


                    <?php

                    $s3BaseUrl =
                        'https://unistudio-product-files-wilson.s3.ap-southeast-2.amazonaws.com/';


                    $extension = strtolower(
                        pathinfo(
                            $file->filename,
                            PATHINFO_EXTENSION
                        )
                    );

                    ?>


                    <div class="col">


                        <div class="product-card">


                            <!-- WHOLE CARD LINK -->

                            <a
                                href="<?= base_url(
                                    'notes/view/' .
                                    $file->id
                                ) ?>"
                                class="product-card-link"
                                aria-label="View note"
                            ></a>



                            <!-- =========================
                                 IMAGE / VIDEO
                            ========================== -->

                            <div class="product-image-container">


                                <?php if (
                                    $extension === 'jpg' ||
                                    $extension === 'jpeg' ||
                                    $extension === 'png' ||
                                    $extension === 'webp' ||
                                    $extension === 'heic' ||
                                    $extension === 'heif'
                                ): ?>


                                    <img
                                        src="<?= $s3BaseUrl .
                                            $file->filename ?>"
                                        class="product-image"
                                        alt="<?= html_escape(
                                            $file->subject
                                        ) ?>"
                                    >



                                <?php elseif (
                                    $extension === 'mp4' ||
                                    $extension === 'mov' ||
                                    $extension === 'm4v'

                                ): ?>


                                    <video
                                        class="product-video"
                                        muted
                                        playsinline
                                    >

                                        <source
                                            src="<?= $s3BaseUrl .
                                                $file->filename ?>"
                                            type="video/mp4"
                                        >

                                    </video>


                                <?php endif; ?>


                            </div>



                            <!-- =========================
                                 NOTE INFORMATION
                            ========================== -->

                            <div class="product-body">


                                <!-- TITLE -->

                                <h5 class="product-title">

                                    <?= html_escape(
                                        $file->subject
                                    ) ?>

                                </h5>



                                <!-- USER + VIEWS -->

                                <div class="product-actions">


                                    <span>

                                        <?= html_escape(
                                            $file->username
                                        ) ?>

                                    </span>


                                    <span>

                                        👁

                                        <?= isset($file->views)
                                            ? (int) $file->views
                                            : 0
                                        ?>

                                    </span>


                                </div>


                            </div>


                        </div>


                    </div>


                <?php endforeach; ?>


            </div>



        <?php else: ?>


            <!-- EMPTY -->

            <div class="empty-products">


                <h4>
                    No notes yet
                </h4>


                <p>
                    Be the first person to share something.
                </p>


                <a
                    href="<?= base_url('upload') ?>"
                    class="btn btn-dark"
                >
                    Create Note
                </a>


            </div>


        <?php endif; ?>


    </div>

</section>



<!-- Bootstrap -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>