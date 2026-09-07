<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>My Subscriptions</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/subscriptions.css') ?>"
    >
</head>

<body>


<!-- HERO -->
<section class="subscriptions-hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <span class="page-label">
                    My UniStudio
                </span>

                <h1>
                    My Subscriptions
                </h1>

                <p>
                    Keep up with the creators and channels
                    you follow on UniStudio.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- SUBSCRIPTIONS -->
<section class="subscriptions-section">

    <div class="container">

        <div class="section-header">

            <div>

                <span class="section-label">
                    Following
                </span>

                <h2>
                    Subscribed Channels
                </h2>

                <p>
                    Creators you are currently subscribed to.
                </p>

            </div>

            <div class="subscription-total">

                <?= count($my_subscriptions) ?>

                <span>
                    subscriptions
                </span>

            </div>

        </div>


        <?php if (!empty($my_subscriptions)): ?>

            <div class="row g-4">

                <?php foreach ($my_subscriptions as $subscription): ?>

                    <div class="col-md-6 col-lg-4">

                        <div class="subscription-card">


                            <!-- AVATAR -->
                            <div class="creator-avatar">

                                <?= strtoupper(
                                    substr(
                                        $subscription->uploader_username,
                                        0,
                                        1
                                    )
                                ) ?>

                            </div>


                            <!-- CREATOR -->
                            <div class="creator-info">

                                <span class="creator-label">
                                    UniStudio Creator
                                </span>

                                <h3>
                                    <?= $subscription->uploader_username ?>
                                </h3>

                                <p>
                                    <?= $subscription->subscriber_count ?>
                                    subscribers
                                </p>

                            </div>


                            <!-- BUTTON -->
                            <a
                                href="<?= base_url(
                                    'uploader_channel/view/' .
                                    rawurlencode(
                                        $subscription->uploader_username
                                    )
                                ) ?>"
                                class="btn btn-dark w-100"
                            >
                                View Channel
                            </a>


                        </div>

                    </div>

                <?php endforeach; ?>

            </div>


        <?php else: ?>


            <!-- EMPTY STATE -->
            <div class="empty-subscriptions">

                <div class="empty-icon">
                    +
                </div>

                <h3>
                    No subscriptions yet
                </h3>

                <p>
                    When you subscribe to a creator,
                    their channel will appear here.
                </p>

                <a
                    href="<?= base_url('products') ?>"
                    class="btn btn-dark"
                >
                    Explore Products
                </a>

            </div>


        <?php endif; ?>


    </div>

</section>


</body>

</html>