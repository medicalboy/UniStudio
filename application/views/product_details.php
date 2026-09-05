<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?= html_escape($file->subject) ?> | UniStudio
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/product_detail.css') ?>"
    >

</head>

<body>


<!-- BREADCRUMB -->
<section class="product-breadcrumb">

    <div class="container">

        <div class="breadcrumb-links">

            <a href="<?= base_url() ?>">
                Home
            </a>

            <span>/</span>

            <a href="<?= base_url('products') ?>">
                Products
            </a>

            <span>/</span>

            <span>
                <?= html_escape($file->subject) ?>
            </span>

        </div>

    </div>

</section>


<!-- PRODUCT -->
<section class="product-section">

    <div class="container">

        <div class="row g-5">

            <!-- LEFT: MEDIA -->
            <div class="col-lg-7">

                <div class="product-media-card">

                    <?php
                    $extension = strtolower(
                        pathinfo($file->filename, PATHINFO_EXTENSION)
                    );
                    ?>


                    <?php if (
                        strpos($file->file_type ?? '', 'image/') === 0 ||
                        in_array($extension, ['jpg', 'jpeg', 'png'])
                    ): ?>
                        <?php
                        $s3BaseUrl =
                            'https://unistudio-product-files-wilson.s3.ap-southeast-2.amazonaws.com/';
                        ?>
                        <img
                            src="<?= $s3BaseUrl . $file->filename ?>"
                            class="product-main-image"
                            alt="<?= html_escape($file->subject) ?>"
                        >


                    <?php elseif (
                        strpos($file->file_type ?? '', 'video/') === 0 ||
                        in_array($extension, ['mp4', 'mkv'])
                    ): ?>

                        <video
                            class="product-main-video"
                            controls>
                        <?php
                        $s3BaseUrl =
                            'https://unistudio-product-files-wilson.s3.ap-southeast-2.amazonaws.com/';
                        ?>
                            <source
                                src="<?= $s3BaseUrl . $file->filename ?>"

                                type="<?= html_escape(
                                    $file->file_type ?? 'video/mp4'
                                ) ?>"
                            >

                        </video>


                    <?php else: ?>

                        <div class="unsupported-file">

                            Preview unavailable

                        </div>

                    <?php endif; ?>

                </div>


                <!-- PRODUCT ACTIVITY -->
                <div class="product-activity">

                    <div class="activity-stat">

                        <span class="activity-label">
                            Views
                        </span>

                        <strong>
                            <?= (int)($file->views ?? 0) ?>
                        </strong>

                    </div>


                    <div class="product-rating-actions">

                        <span>
                            Was this useful?
                        </span>

                        <a
                            href="<?= base_url(
                                'products/like/' .
                                $file->id
                            ) ?>"
                            class="rating-button">

                            👍

                            <strong>
                                <?= (int)($file->likes ?? 0) ?>
                            </strong>

                        </a>


                        <a
                            href="<?= base_url(
                                'products/dislike/' .
                                $file->id
                            ) ?>"
                            class="rating-button">

                            👎

                            <strong>
                                <?= (int)($file->dislikes ?? 0) ?>
                            </strong>

                        </a>

                    </div>

                </div>

            </div>


            <!-- RIGHT: PRODUCT INFO -->
            <div class="col-lg-5">

                <div class="product-info">

                    <span class="product-label">
                        UniStudio Marketplace
                    </span>

                    <h1 class="product-title">
                        <?= html_escape($file->subject) ?>
                    </h1>


                    <div class="product-seller">

                        <div class="seller-avatar">

                            <?= strtoupper(
                                substr(
                                    $file->username ?? 'U',
                                    0,
                                    1
                                )
                            ) ?>

                        </div>

                        <div>

                            <span>
                                Uploaded by
                            </span>

                            <strong>
                                <?= html_escape($file->username) ?>
                            </strong>

                        </div>

                    </div>


                    <p class="product-description">
                        <?= nl2br(html_escape($file->description ?? '')) ?>
                    </p>


                    <div class="product-details-list">

                        <div class="detail-row">

                            <span>
                                Tutor
                            </span>

                            <strong>
                                <?= html_escape($file->username) ?>
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span>
                                Institution
                            </span>

                            <strong>
                                University of Queensland
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span>
                                Resource type
                            </span>

                            <strong>
                                <?= in_array(
                                    $extension,
                                    ['mp4', 'mkv']
                                ) ? 'Video' : 'Digital Resource' ?>
                            </strong>

                        </div>

                    </div>


                    <!-- PURCHASE -->
                    <div class="purchase-box">

                        <div>

                            <span class="price-label">
                                Price
                            </span>

                            <div class="product-price">
                                $50.00
                            </div>

                        </div>


                        <a
                            href="<?= base_url(
                                'cart/add/' .
                                $file->id
                            ) ?>"
                            class="btn btn-dark btn-lg add-cart-button">

                            Add to cart

                        </a>

                    </div>


                    <div class="purchase-benefits">

                        <div>
                            ✓ Instant access
                        </div>

                        <div>
                            ✓ Secure checkout
                        </div>

                        <div>
                            ✓ Community support
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- CREATOR -->
<section class="creator-section">

    <div class="container">

        <div class="creator-card">

            <div class="creator-left">

                <div class="creator-avatar">

                    <?= strtoupper(
                        substr(
                            $file->username ?? 'U',
                            0,
                            1
                        )
                    ) ?>

                </div>


                <div>

                    <span class="creator-label">
                        About the creator
                    </span>

                    <h3>
                        <?= html_escape($file->username) ?>
                    </h3>

                    <p>
                        UniStudio tutor and community contributor.
                    </p>

                </div>

            </div>


            <div class="creator-actions">

                <a
                    href="<?= base_url('uploader_channel') ?>"
                    class="btn btn-outline-dark">

                    View channel

                </a>

                <button
                    type="button"
                    class="btn btn-dark">

                    Subscribe

                </button>

            </div>

        </div>

    </div>

</section>


<!-- DETAILS -->
<section class="details-section">

    <div class="container">

        <div class="row g-5">

            <div class="col-lg-8">

                <span class="section-label">
                    Product details
                </span>

                <h2>
                    About this resource
                </h2>

                <div class="description-content">

                        <?= nl2br(html_escape($file->description ?? '')) ?>

                </div>

            </div>


            <div class="col-lg-4">

                <div class="details-card">

                    <h4>
                        Resource information
                    </h4>


                    <div class="details-item">

                        <span>
                            Uploaded by
                        </span>

                        <strong>
                            <?= html_escape($file->username) ?>
                        </strong>

                    </div>


                    <div class="details-item">

                        <span>
                            Views
                        </span>

                        <strong>
                            <?= (int)($file->views ?? 0) ?>
                        </strong>

                    </div>


                    <div class="details-item">

                        <span>
                            Likes
                        </span>

                        <strong>
                            <?= (int)($file->likes ?? 0) ?>
                        </strong>

                    </div>


                    <div class="details-item">

                        <span>
                            File
                        </span>

                        <strong>
                            <?= html_escape($extension) ?>
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- REVIEWS -->
<section class="reviews-section">

    <div class="container">

        <div class="section-heading">

            <div>

                <span class="section-label">
                    Community
                </span>

                <h2>
                    Reviews & questions
                </h2>

                <p>
                    See what other students are saying about this resource.
                </p>

            </div>


            <div class="review-count">

                <?= !empty($comments)
                    ? count($comments)
                    : 0 ?>

                <span>
                    Comments
                </span>

            </div>

        </div>


        <div class="row g-5">

            <!-- COMMENTS -->
            <div class="col-lg-7">

                <?php if (!empty($comments)): ?>

                    <div class="comment-list">

                        <?php foreach ($comments as $comment): ?>

                            <div class="comment-card">

                                <div class="comment-header">

                                    <div class="comment-user">

                                        <div class="comment-avatar">

                                            <?= strtoupper(
                                                substr(
                                                    $comment->username ?? 'U',
                                                    0,
                                                    1
                                                )
                                            ) ?>

                                        </div>

                                        <div>

                                            <strong>
                                                <?= html_escape(
                                                    $comment->username
                                                ) ?>
                                            </strong>

                                            <span>
                                                UniStudio member
                                            </span>

                                        </div>

                                    </div>


                                    <time>
                                        <?= html_escape(
                                            $comment->created_at
                                        ) ?>
                                    </time>

                                </div>


                                <p class="comment-content">

                            <?= nl2br(html_escape($comment->content ?? '')) ?>


                                </p>

                            </div>

                        <?php endforeach; ?>

                    </div>


                <?php else: ?>

                    <div class="empty-comments">

                        <h4>
                            No comments yet
                        </h4>

                        <p>
                            Be the first person to ask a question
                            or share your feedback.
                        </p>

                    </div>

                <?php endif; ?>

            </div>


            <!-- COMMENT FORM -->
            <div class="col-lg-5">

                <div class="comment-form-card">

                    <span class="section-label">
                        Join the discussion
                    </span>

                    <h3>
                        Ask a question
                    </h3>

                    <p>
                        Send a comment or question to
                        <strong>
                            <?= html_escape($file->username) ?>
                        </strong>.
                    </p>


                    <?php if (
                        $this->session->userdata('logged_in')
                    ): ?>

                        <form
                            method="post"
                            action="<?= base_url(
                                'products/add_comment/' .
                                $file->id
                            ) ?>">

                            <label
                                for="comment"
                                class="form-label">
                                Your message
                            </label>

                            <textarea
                                name="comment"
                                id="comment"
                                class="form-control"
                                rows="6"
                                placeholder="Write your question or review..."
                                required></textarea>


                            <button
                                type="submit"
                                class="btn btn-dark w-100 mt-3">

                                Post comment

                            </button>

                        </form>


                    <?php else: ?>

                        <div class="login-comment-message">

                            <p>
                                Please log in to leave a comment.
                            </p>

                            <a
                                href="<?= base_url('login') ?>"
                                class="btn btn-dark">

                                Log in to comment

                            </a>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</section>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>