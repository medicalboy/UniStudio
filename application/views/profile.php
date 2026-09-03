<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Profile | UniStudio</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/profile.css') ?>"
    >

</head>

<body>


<!-- PROFILE HERO -->
<section class="profile-hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <span class="profile-label">
                    My account
                </span>

                <h1>
                    Profile Settings
                </h1>

                <p>
                    Manage your personal information and
                    UniStudio account details.
                </p>

            </div>


            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">

                <a
                    href="<?= base_url('dashboard') ?>"
                    class="btn btn-light">

                    Back to Dashboard

                </a>

            </div>

        </div>

    </div>

</section>


<!-- PROFILE SUMMARY -->
<section class="profile-summary">

    <div class="container">

        <div class="profile-summary-card">

            <div class="profile-user">

                <div class="profile-avatar">

                    <?= strtoupper(
                        substr(
                            $username ?? 'U',
                            0,
                            1
                        )
                    ) ?>

                </div>


                <div>

                    <span class="profile-member-label">
                        UniStudio Member
                    </span>

                    <h3>
                        <?= html_escape($username ?? 'User') ?>
                    </h3>

                    <p>
                        <?= html_escape($email ?? '') ?>
                    </p>

                </div>

            </div>


            <div class="profile-summary-actions">

                <a
                    href="<?= base_url('uploader_channel') ?>"
                    class="btn btn-outline-dark">

                    View Channel

                </a>

                <a
                    href="<?= base_url('upload') ?>"
                    class="btn btn-dark">

                    Upload Product

                </a>

            </div>

        </div>

    </div>

</section>


<!-- PROFILE CONTENT -->
<section class="profile-section">

    <div class="container">

        <div class="profile-layout">


            <!-- SIDEBAR -->
            <aside class="profile-sidebar">

                <div class="sidebar-heading">

                    <span>
                        Account
                    </span>

                    <h4>
                        Settings
                    </h4>

                </div>


                <nav class="profile-menu">

                    <a
                        href="<?= base_url('profile') ?>"
                        class="profile-menu-link active">

                        <span>●</span>

                        Personal Information

                    </a>


                    <a
                        href="<?= base_url('dashboard') ?>"
                        class="profile-menu-link">

                        <span>▣</span>

                        Dashboard

                    </a>


                    <a
                        href="<?= base_url('uploader_channel') ?>"
                        class="profile-menu-link">

                        <span>▰</span>

                        Your Channel

                    </a>


                    <a
                        href="<?= base_url('products/fetch_detail') ?>"
                        class="profile-menu-link">

                        <span>▶</span>

                        Your Watch

                    </a>


                    <a
                        href="<?= base_url('cart') ?>"
                        class="profile-menu-link">

                        <span>●</span>

                        Shopping Cart

                    </a>

                </nav>


                <div class="account-security">

                    <span class="security-icon">
                        ✓
                    </span>

                    <div>

                        <strong>
                            Account protected
                        </strong>

                        <p>
                            Keep your email and account
                            information up to date.
                        </p>

                    </div>

                </div>

            </aside>


            <!-- MAIN PROFILE -->
            <main class="profile-content">


                <!-- TITLE -->
                <div class="profile-content-header">

                    <span class="section-label">
                        Personal information
                    </span>

                    <h2>
                        Your account details
                    </h2>

                    <p>
                        Update the basic information associated
                        with your UniStudio account.
                    </p>

                </div>


                <?php echo form_open(base_url('profile/edit')); ?>


                <!-- BASIC INFORMATION -->
                <div class="settings-card">

                    <div class="settings-card-header">

                        <div>

                            <h3>
                                Basic Information
                            </h3>

                            <p>
                                Your public account information.
                            </p>

                        </div>

                    </div>


                    <div class="settings-card-body">


                        <!-- USERNAME -->
                        <div class="settings-row">

                            <div class="settings-label">

                                <label for="username">
                                    Username
                                </label>

                                <span>
                                    This name appears on your
                                    UniStudio profile and products.
                                </span>

                            </div>


                            <div class="settings-input">

                                <input
                                    type="text"
                                    name="username"
                                    id="username"
                                    class="form-control"
                                    value="<?= html_escape(
                                        $username ?? ''
                                    ) ?>"
                                    required
                                >

                            </div>

                        </div>


                        <!-- EMAIL -->
                        <div class="settings-row">

                            <div class="settings-label">

                                <label for="email">
                                    Email Address
                                </label>

                                <span>
                                    Used for account communication
                                    and verification.
                                </span>

                            </div>


                            <div class="settings-input">

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    value="<?= html_escape(
                                        $email ?? ''
                                    ) ?>"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    <!-- SAVE -->
                    <div class="settings-card-footer">

                        <span>
                            Make sure your information is correct
                            before saving.
                        </span>

                        <button
                            type="submit"
                            class="btn btn-dark">

                            Save Changes

                        </button>

                    </div>

                </div>


                <?php echo form_close(); ?>


                <!-- ACCOUNT ACTIVITY -->
                <div class="account-section">

                    <div class="profile-content-header">

                        <span class="section-label">
                            UniStudio
                        </span>

                        <h2>
                            Your workspace
                        </h2>

                        <p>
                            Quickly access the areas connected
                            to your account.
                        </p>

                    </div>


                    <div class="row g-3">


                        <!-- CHANNEL -->
                        <div class="col-md-6">

                            <a
                                href="<?= base_url('uploader_channel') ?>"
                                class="workspace-link">

                                <div class="workspace-card">

                                    <div class="workspace-icon">
                                        ▰
                                    </div>

                                    <div>

                                        <h4>
                                            Your Channel
                                        </h4>

                                        <p>
                                            Manage products and
                                            resources you've uploaded.
                                        </p>

                                        <span>
                                            Manage channel →
                                        </span>

                                    </div>

                                </div>

                            </a>

                        </div>


                        <!-- DASHBOARD -->
                        <div class="col-md-6">

                            <a
                                href="<?= base_url('dashboard') ?>"
                                class="workspace-link">

                                <div class="workspace-card">

                                    <div class="workspace-icon">
                                        ▣
                                    </div>

                                    <div>

                                        <h4>
                                            Dashboard
                                        </h4>

                                        <p>
                                            Review your account and
                                            UniStudio activity.
                                        </p>

                                        <span>
                                            Open dashboard →
                                        </span>

                                    </div>

                                </div>

                            </a>

                        </div>


                        <!-- WATCH -->
                        <div class="col-md-6">

                            <a
                                href="<?= base_url(
                                    'products/fetch_detail'
                                ) ?>"
                                class="workspace-link">

                                <div class="workspace-card">

                                    <div class="workspace-icon">
                                        ▶
                                    </div>

                                    <div>

                                        <h4>
                                            Your Watch
                                        </h4>

                                        <p>
                                            Return to products and
                                            resources you've viewed.
                                        </p>

                                        <span>
                                            View activity →
                                        </span>

                                    </div>

                                </div>

                            </a>

                        </div>


                        <!-- UPLOAD -->
                        <div class="col-md-6">

                            <a
                                href="<?= base_url('upload') ?>"
                                class="workspace-link">

                                <div class="workspace-card">

                                    <div class="workspace-icon">
                                        +
                                    </div>

                                    <div>

                                        <h4>
                                            Upload Product
                                        </h4>

                                        <p>
                                            Share a new resource with
                                            the UniStudio community.
                                        </p>

                                        <span>
                                            Upload product →
                                        </span>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                </div>


                <!-- SECURITY -->
                <div class="security-section">

                    <div>

                        <span class="section-label">
                            Security
                        </span>

                        <h3>
                            Password & account security
                        </h3>

                        <p>
                            Need to change or recover your password?
                        </p>

                    </div>


                    <a
                        href="<?= base_url('email') ?>"
                        class="btn btn-outline-dark">

                        Reset Password

                    </a>

                </div>

            </main>

        </div>

    </div>

</section>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>