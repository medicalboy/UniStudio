<!-- PRODUCTS -->
    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/products.css') ?>"
    >
<section class="products-section">

    <div class="container">

        <div class="section-header">

            <div>
                <span class="section-label">
                    Products
                </span>

                <h2>
                    Explore all products
                </h2>

                <p>
                    Explore products and resources from our community.
                </p>
            </div>

            <a
                href="<?= base_url('uploader_channel') ?>"
                class="view-all-link"
            >
                Your channel →
            </a>

        </div>


        <?php if (!empty($files)): ?>

            <?php
            $s3BaseUrl =
                'https://unistudio-product-files-wilson.s3.ap-southeast-2.amazonaws.com/';
            ?>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">

                <?php foreach ($files as $file): ?>

                    <div class="col">

                        <div class="product-card position-relative">

                            <!-- Makes the card clickable -->
                            <a
                                href="<?= base_url(
                                    'products/watch/' . $file->id
                                ) ?>"
                                class="product-card-link"
                            ></a>


                            <?php
                            $extension = strtolower(
                                pathinfo(
                                    $file->filename,
                                    PATHINFO_EXTENSION
                                )
                            );
                            ?>


                            <!-- PRODUCT IMAGE -->
                            <div class="product-image-container">

                                <?php if (
                                    $extension === 'jpg' ||
                                    $extension === 'jpeg' ||
                                    $extension === 'png'
                                ): ?>

                                    <img
                                        src="<?= $s3BaseUrl . $file->filename ?>"
                                        class="product-image"
                                        alt="<?= html_escape($file->subject) ?>"
                                    >

                                <?php elseif ($extension === 'mp4'): ?>

                                    <video
                                        class="product-video"
                                        controls
                                    >
                                        <source
                                            src="<?= $s3BaseUrl . $file->filename ?>"
                                            type="video/mp4"
                                        >
                                    </video>

                                <?php endif; ?>

                            </div>


                            <!-- PRODUCT INFORMATION -->
                            <div class="product-body">

                                <h5 class="product-title">
                                    <?= html_escape($file->subject) ?>
                                </h5>

                                <p class="product-description">
                                    <?= html_escape($file->description) ?>
                                </p>


                                <div class="product-actions">

                                    <a
                                        href="<?= base_url(
                                            'products/watch/' .
                                            $file->id
                                        ) ?>"
                                        class="learn-more-link"
                                    >
                                        Learn more
                                    </a>

                                    <a
                                        href="<?= base_url(
                                            'cart/add/' .
                                            rawurlencode($file->filename)
                                        ) ?>"
                                        class="btn btn-dark btn-sm"
                                    >
                                        Add to cart
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>


        <?php else: ?>

            <div class="empty-products">

                <h4>No products available yet</h4>

                <p>
                    Be the first person to upload a product.
                </p>

                <a
                    href="<?= base_url('upload') ?>"
                    class="btn btn-dark"
                >
                    Upload product
                </a>

            </div>

        <?php endif; ?>

    </div>

</section>