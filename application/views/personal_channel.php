<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Your Channel</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/channel.css') ?>"
    >
</head>

<body>

<!-- CHANNEL HERO -->
<section class="channel-hero">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <span class="channel-label">
                    Creator Channel
                </span>

                <h1>
                    <?= html_escape($username) ?>'s Channel
                </h1>

                <p>
                <?php if ($is_own_channel): ?>

                    Manage your uploaded products, review your content,
                    and keep building your personal storefront.

                <?php else: ?>

                    Explore products and learning resources shared by
                    <?= html_escape($username) ?>.

                <?php endif; ?>
                </p>

            </div>

            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
            <?php if ($is_own_channel): ?>

                <a
                    href="<?= base_url('upload') ?>"
                    class="btn btn-light btn-lg"
                >
                    + Upload Product
                </a>

            <?php else: ?>
                <?php if (!$current_user): ?>

                    <a
                        href="<?= base_url('login') ?>"
                        class="btn btn-light btn-lg"
                    >
                        Log in to subscribe
                    </a>

                <?php elseif ($is_subscribed): ?>
                    <a
                        href="<?= base_url(
                            'uploader_channel/unsubscribe/' .
                            rawurlencode($username)
                        ) ?>"
                        class="btn btn-outline-light btn-lg"
                    >
                        Subscribed
                    </a>
                <?php else: ?>

                    <a
                        href="<?= base_url(
                            'uploader_channel/subscribe/' .
                            rawurlencode($username)
                        ) ?>"
                        class="btn btn-light btn-lg"
                    >
                        Subscribe
                    </a>

                <?php endif; ?>
            <?php endif; ?>
        </div>

    </div>
</section>


<!-- CHANNEL SUMMARY -->
<section class="channel-summary">

    <div class="container">

        <div class="summary-card">

            <div class="channel-avatar">
                <?= strtoupper(substr($username, 0, 1)) ?>
            </div>

            <div class="channel-info">

                <h3>
                    <?= html_escape($username) ?>
                </h3>
                <p>
                    <?= (int) $subscriber_count ?>
                    subscribers
                </p>
                <p>
                    UniStudio Creator
                </p>

            </div>

            <div class="channel-stats">

                <div class="stat-item">

                    <strong>
                        <?= !empty($files) ? count($files) : 0 ?>
                    </strong>

                    <span>
                        Products
                    </span>

                </div>

                <div class="stat-item">

                    <strong>
                        <?= !empty($files) ? array_sum(array_map(function($file) {
                            return isset($file->views) ? (int)$file->views : 0;
                        }, $files)) : 0 ?>
                    </strong>

                    <span>
                        Views
                    </span>

                </div>

                <div class="stat-item">

                    <strong>
                        <?= !empty($files) ? array_sum(array_map(function($file) {
                            return isset($file->likes) ? (int)$file->likes : 0;
                        }, $files)) : 0 ?>
                    </strong>

                    <span>
                        Likes
                    </span>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- PRODUCTS -->
<section class="channel-products">

    <div class="container">

        <div class="section-header">

            <div>

                <span class="section-label">
                    <?= $is_own_channel
                        ? 'Your catalogue'
                        : html_escape($username) . "'s catalogue"
                    ?>
                </span>

                <h2>
                    Uploaded Products
                </h2>

                <p>
                    <?php if ($is_own_channel): ?>

                        Products currently published on your channel.

                    <?php else: ?>

                        Products published by
                        <?= html_escape($username) ?>.

                    <?php endif; ?>
                </p>

            </div>

            <?php if ($is_own_channel): ?>

                <a
                    href="<?= base_url('upload') ?>"
                    class="upload-link"
                >
                    Add new product →
                </a>

            <?php endif; ?>
        </div>


        <?php if (!empty($files)): ?>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">
                <?php
                $s3BaseUrl =
                    'https://unistudio-product-files-wilson.s3.ap-southeast-2.amazonaws.com/';
                ?>
                <?php foreach ($files as $file): ?>

                    <div class="col">

                        <div class="product-card">

                            <div class="product-image-container">
                            <img
                                src="<?= $s3BaseUrl . $file->filename ?>"
                                class="product-image"
                                alt="<?= html_escape($file->subject) ?>"
                            >

                            </div>

                            <div class="product-body">

                                <h5 class="product-title">
                                    <?= html_escape($file->subject) ?>
                                </h5>

                                <p class="product-description">
                                    <?= html_escape($file->description) ?>
                                </p>

                                <div class="product-meta">

                                    <span>
                                        👁 <?= isset($file->views) ? (int)$file->views : 0 ?>
                                    </span>

                                    <span>
                                        ♥ <?= isset($file->likes) ? (int)$file->likes : 0 ?>
                                    </span>

                                </div>

                                <div class="product-actions">

                                    <a
                                        href="<?= base_url(
                                            'products/load_file/' .
                                            $file->id
                                        ) ?>"
                                        class="btn btn-outline-dark btn-sm">
                                        View
                                    </a>
                                    <?php if ($is_own_channel): ?>

                                        <a
                                            href="<?= base_url(
                                                'products/load_file/' .
                                                $file->id
                                            ) ?>"
                                            class="manage-link"
                                        >
                                            Manage
                                        </a>

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="empty-channel">

                <div class="empty-icon">
                    +
                </div>

            <?php if ($is_own_channel): ?>

                <h3>
                    Your channel is empty
                </h3>

                <p>
                    Upload your first product to start building your channel.
                </p>

                <a
                    href="<?= base_url('upload') ?>"
                    class="btn btn-dark"
                >
                    Upload your first product
                </a>

            <?php else: ?>

                <h3>
                    No products yet
                </h3>

                <p>
                    <?= html_escape($username) ?>
                    hasn't published any products yet.
                </p>

            <?php endif; ?>

            </div>

        <?php endif; ?>

    </div>

</section>


<!-- CREATOR CTA -->
<?php if ($is_own_channel): ?>

<section class="creator-cta">

    <div class="container">

        <div class="creator-cta-box">

            <div>

                <span>
                    Grow your channel
                </span>

                <h2>
                    Share more with your community
                </h2>

                <p>
                    Add new products and learning resources to keep
                    your channel active.
                </p>

            </div>

            <a
                href="<?= base_url('upload') ?>"
                class="btn btn-light btn-lg"
            >
                Upload Product
            </a>

        </div>

    </div>

</section>

<?php endif; ?>

</body>
</html>