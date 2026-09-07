<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard | UniStudio</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/dashboard.css') ?>"
    >

</head>

<body>


<!-- DASHBOARD HERO -->
<section class="dashboard-hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <span class="dashboard-label">
                    My account
                </span>

                <h1>
                    Welcome back,
                    <?= html_escape(
                        $this->session->userdata('username') ?? 'User'
                    ) ?>
                </h1>

                <p>
                    Manage your account, creator channel,
                    learning activity and UniStudio resources
                    from one place.
                </p>

            </div>


            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">

                <a
                    href="<?= base_url('upload') ?>"
                    class="btn btn-light btn-lg">

                    + Upload Product

                </a>

            </div>

        </div>

    </div>

</section>


<!-- ACCOUNT SUMMARY -->
<section class="account-summary">

    <div class="container">

        <div class="summary-panel">

            <div class="summary-user">

                <div class="summary-avatar">

                    <?= strtoupper(
                        substr(
                            $this->session->userdata('username') ?? 'U',
                            0,
                            1
                        )
                    ) ?>

                </div>


                <div>

                    <h3>
                        <?= html_escape(
                            $this->session->userdata('username') ?? 'User'
                        ) ?>
                    </h3>

                    <p>
                        UniStudio member
                    </p>

                </div>

            </div>


            <div class="summary-actions">

                <a
                    href="<?= base_url('profile') ?>"
                    class="btn btn-outline-dark">

                    Edit Profile

                </a>

                <a
                    href="<?= base_url('uploader_channel') ?>"
                    class="btn btn-dark">

                    View Channel

                </a>

            </div>

        </div>

    </div>

</section>


<!-- DASHBOARD -->
<section class="dashboard-section">

    <div class="container">

        <div class="dashboard-layout">


            <!-- SIDEBAR -->
            <aside class="dashboard-sidebar">

                <div class="sidebar-heading">

                    <span>
                        Workspace
                    </span>

                    <h4>
                        Dashboard
                    </h4>

                </div>


                <nav class="sidebar-menu">

                    <a
                        href="<?= base_url('dashboard') ?>"
                        class="sidebar-link active">

                        <span class="sidebar-icon">⌂</span>

                        Dashboard

                    </a>


                    <a
                        href="<?= base_url('profile') ?>"
                        class="sidebar-link">

                        <span class="sidebar-icon">●</span>

                        Personal Info

                    </a>


                    <a
                        href="<?= base_url('uploader_channel') ?>"
                        class="sidebar-link">

                        <span class="sidebar-icon">▰</span>

                        Your Channel

                    </a>


                    <a
                        href="<?= base_url('products/get_subscrptions') ?>"
                        class="sidebar-link">

                        <span class="sidebar-icon">▶</span>

                        Your Watch

                    </a>


                    <a
                        href="<?= base_url('products') ?>"
                        class="sidebar-link">

                        <span class="sidebar-icon">▥</span>

                        Statistics

                    </a>


                    <a
                        href="<?= base_url('cart') ?>"
                        class="sidebar-link">

                        <span class="sidebar-icon">🛒</span>

                        Shopping Cart

                    </a>

                </nav>


                <div class="sidebar-help">

                    <strong>
                        Need help?
                    </strong>

                    <p>
                        Manage your UniStudio account
                        and resources from this dashboard.
                    </p>

                    <a href="#">
                        Help Centre →
                    </a>

                </div>

            </aside>


            <!-- MAIN CONTENT -->
            <main class="dashboard-content">


                <!-- SECTION HEADER -->
                <div class="dashboard-content-header">

                    <div>

                        <span class="section-label">
                            Overview
                        </span>

                        <h2>
                            Manage your UniStudio account
                        </h2>

                        <p>
                            Quick access to the tools and areas
                            you use most.
                        </p>

                    </div>

                </div>


                <!-- CARDS -->
                <div class="row g-4">


                    <!-- PROFILE -->
                    <div class="col-xl-6">

                        <a
                            href="<?= base_url('profile') ?>"
                            class="dashboard-card-link">

                            <article class="dashboard-card">

                                <div class="dashboard-card-content">

                                    <span class="card-label">
                                        Account
                                    </span>

                                    <h3>
                                        Personal Information
                                    </h3>

                                    <p>
                                        Manage your username, email
                                        and personal account information.
                                    </p>

                                    <span class="card-action">
                                        Manage profile →
                                    </span>

                                </div>


                                <div class="dashboard-card-image">

                                    <img
                                        src="<?= base_url(
                                            'assets/images/profile.jpg'
                                        ) ?>"
                                        alt="Personal Information"
                                    >

                                </div>

                            </article>

                        </a>

                    </div>


                    <!-- CHANNEL -->
                    <div class="col-xl-6">

                        <a
                            href="<?= base_url('uploader_channel') ?>"
                            class="dashboard-card-link">

                            <article class="dashboard-card">

                                <div class="dashboard-card-content">

                                    <span class="card-label">
                                        Creator
                                    </span>

                                    <h3>
                                        Your Channel
                                    </h3>

                                    <p>
                                        Review your uploaded products
                                        and manage your personal storefront.
                                    </p>

                                    <span class="card-action">
                                        Manage channel →
                                    </span>

                                </div>


                                <div class="dashboard-card-image">

                                    <img
                                        src="<?= base_url(
                                            'assets/images/channel.jpg'
                                        ) ?>"
                                        alt="Your Channel"
                                    >

                                </div>

                            </article>

                        </a>

                    </div>


                    <!-- WATCH -->
                    <div class="col-xl-6">

                        <a
                            href="<?= base_url('products/get_subscrptions') ?>"
                            class="dashboard-card-link">

                            <article class="dashboard-card">

                                <div class="dashboard-card-content">

                                    <span class="card-label">
                                        Learning
                                    </span>

                                    <h3>
                                        Your Watch
                                    </h3>

                                    <p>
                                        Return to products, videos
                                        and learning resources you've viewed.
                                    </p>

                                    <span class="card-action">
                                        View activity →
                                    </span>

                                </div>


                                <div class="dashboard-card-image">

                                    <img
                                        src="<?= base_url(
                                            'assets/images/watch.jpg'
                                        ) ?>"
                                        alt="Your Watch"
                                    >

                                </div>

                            </article>

                        </a>

                    </div>


                    <!-- STATISTICS -->
                    <div class="col-xl-6">

                        <a
                            href="<?= base_url('products') ?>"
                            class="dashboard-card-link">

                            <article class="dashboard-card">

                                <div class="dashboard-card-content">

                                    <span class="card-label">
                                        Insights
                                    </span>

                                    <h3>
                                        Product Statistics
                                    </h3>

                                    <p>
                                        Review views, likes and engagement
                                        across your uploaded resources.
                                    </p>

                                    <span class="card-action">
                                        View statistics →
                                    </span>

                                </div>


                                <div class="dashboard-card-image">

                                    <img
                                        src="<?= base_url(
                                            'assets/images/statistics.jpg'
                                        ) ?>"
                                        alt="Statistics"
                                    >

                                </div>

                            </article>

                        </a>

                    </div>

                </div>

            </main>

        </div>

    </div>

</section>


<!-- CREATOR CTA -->
<section class="dashboard-cta">

    <div class="container">

        <div class="dashboard-cta-box">

            <div>

                <span>
                    Creator tools
                </span>

                <h2>
                    Ready to share something new?
                </h2>

                <p>
                    Upload a product or learning resource
                    and add it to your channel.
                </p>

            </div>


            <a
                href="<?= base_url('upload') ?>"
                class="btn btn-light btn-lg">

                Upload Product

            </a>

        </div>

    </div>

</section>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>