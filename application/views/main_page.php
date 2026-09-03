<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Courses & Products</title>

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

<!-- HERO -->
<section class="hero-section">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <span class="hero-label">
                    Learn smarter
                </span>

                <h1 class="hero-title">
                    Discover useful products and learning resources
                </h1>

                <p class="hero-text">
                    Explore resources uploaded by tutors and students,
                    discover new content, and manage everything from your dashboard.
                </p>

                <div class="hero-actions">

                    <a
                        href="<?= base_url('products') ?>"
                        class="btn btn-dark btn-lg">
                        Explore products
                    </a>

                    <a
                        href="<?= base_url('dashboard') ?>"
                        class="btn btn-outline-dark btn-lg">
                        Dashboard
                    </a>

                </div>

            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">

                <div class="hero-card">

                    <div class="hero-card-small">
                        Popular this week
                    </div>

                    <h3>
                        Find products that make study easier
                    </h3>

                    <p>
                        Browse learning resources, accessories,
                        videos and other useful products.
                    </p>

                </div>

            </div>

        </div>

    </div>
</section>


<!-- BENEFITS -->
<section class="benefit-section">

    <div class="container">

        <div class="row g-3">

            <div class="col-md-4">

                <div class="benefit-box">
                    <div class="benefit-icon">✓</div>

                    <div>
                        <h5>Quality resources</h5>
                        <p>Discover content uploaded by the community.</p>
                    </div>
                </div>

            </div>

            <div class="col-md-4">

                <div class="benefit-box">
                    <div class="benefit-icon">⚡</div>

                    <div>
                        <h5>Easy access</h5>
                        <p>Quickly browse and manage your products.</p>
                    </div>
                </div>

            </div>

            <div class="col-md-4">

                <div class="benefit-box">
                    <div class="benefit-icon">★</div>

                    <div>
                        <h5>Community driven</h5>
                        <p>Learn from tutors and other students.</p>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>


<!-- PRODUCTS -->
<section class="products-section">

    <div class="container">

        <div class="section-header">

            <div>

                <span class="section-label">
                    Featured
                </span>

                <h2>
                    Make your study easy
                </h2>

                <p>
                    Explore products and resources from our community.
                </p>

            </div>

            <a
                href="<?= base_url('uploader_channel') ?>"
                class="view-all-link">
                Your channel →
            </a>

        </div>


        <?php if (!empty($files)): ?>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">

                <?php foreach ($files as $file): ?>

                    <div class="col">

                    <div class="product-card position-relative">

                        <a
                            href="<?= base_url('products/watch/' . $file->id) ?>"
                            class="product-card-link"
                            aria-label="View <?= html_escape($file->subject) ?>">
                        </a>
                            <?php
                            $extension = strtolower(
                                pathinfo(
                                    $file->filename,
                                    PATHINFO_EXTENSION
                                )
                            );
                            ?>

                            <div class="product-image-container">

                                <?php if (
                                    $extension === 'jpg' ||
                                    $extension === 'jpeg' ||
                                    $extension === 'png'
                                ): ?>

                                    <img
                                        src="<?= base_url(
                                            'uploads/' .
                                            rawurlencode($file->filename)
                                        ) ?>"
                                        class="product-image"
                                        alt="<?= html_escape($file->subject) ?>"
                                    >

                                <?php elseif ($extension === 'mp4'): ?>

                                    <video
                                        class="product-video"
                                        controls
                                    >
                                        <source
                                            src="<?= base_url(
                                                'uploads/' .
                                                rawurlencode($file->filename)
                                            ) ?>"
                                            type="video/mp4"
                                        >
                                    </video>

                                <?php endif; ?>

                            </div>


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
                                        class="learn-more-link">
                                        Learn more
                                    </a>

                                    <a
                                        href="<?= base_url(
                                            'cart/add/' .
                                            rawurlencode($file->filename)
                                        ) ?>"
                                        class="btn btn-dark btn-sm">
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
                    class="btn btn-dark">
                    Upload product
                </a>

            </div>

        <?php endif; ?>

    </div>

</section>


<!-- WHY CHOOSE US -->
<section class="why-section">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-5">

                <span class="section-label">
                    Why UniStudio
                </span>

                <h2>
                    Everything you need in one place
                </h2>

                <p>
                    UniStudio brings products, learning resources,
                    tutors and students together in one platform.
                </p>

            </div>

            <div class="col-lg-7">

                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="feature-card">
                            <h5>Personal channel</h5>
                            <p>
                                Upload and manage your own resources.
                            </p>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="feature-card">
                            <h5>Product discovery</h5>
                            <p>
                                Browse resources uploaded by other users.
                            </p>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="feature-card">
                            <h5>Comments and reviews</h5>
                            <p>
                                Interact with creators and other students.
                            </p>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="feature-card">
                            <h5>Easy management</h5>
                            <p>
                                Control everything from your dashboard.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- CTA -->
<section class="cta-section">

    <div class="container">

        <div class="cta-box">

            <div>

                <h2>
                    Ready to share something?
                </h2>

                <p>
                    Upload your own product or learning resource today.
                </p>

            </div>

            <a
                href="<?= base_url('upload') ?>"
                class="btn btn-light btn-lg">
                Upload product
            </a>

        </div>

    </div>

</section>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>