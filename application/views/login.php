<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | UniStudio</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/login.css') ?>"
    >
</head>

<body>

<div class="login-page">

    <!-- LEFT SIDE -->
    <section class="login-brand">

        <a href="<?= base_url() ?>" class="brand-logo">
            UniStudio
        </a>

        <div class="brand-content">

            <span class="brand-label">
                Welcome back
            </span>

            <h1>
                Continue learning, sharing and growing.
            </h1>

            <p class="brand-description">
                Sign in to access your dashboard, manage your channel,
                discover products and continue where you left off.
            </p>


            <div class="benefit-list">

                <div class="benefit-item">

                    <div class="benefit-icon">
                        ✓
                    </div>

                    <div>
                        <strong>Your personal dashboard</strong>

                        <p>
                            Manage your account, products and activity
                            from one place.
                        </p>
                    </div>

                </div>


                <div class="benefit-item">

                    <div class="benefit-icon">
                        ✓
                    </div>

                    <div>
                        <strong>Your creator channel</strong>

                        <p>
                            Upload products and manage the resources
                            you've shared.
                        </p>
                    </div>

                </div>


                <div class="benefit-item">

                    <div class="benefit-icon">
                        ✓
                    </div>

                    <div>
                        <strong>Your learning activity</strong>

                        <p>
                            Return to products, courses and resources
                            you've discovered.
                        </p>
                    </div>

                </div>

            </div>

        </div>


        <div class="brand-footer">
            © <?= date('Y') ?> UniStudio
        </div>

    </section>


    <!-- RIGHT SIDE -->
    <section class="login-form-section">

        <!-- SIGNUP LINK -->
        <div class="login-top">

            <span>
                New to UniStudio?
            </span>

            <a
                href="<?= base_url('signup') ?>"
                class="btn btn-outline-dark">
                Create account
            </a>

        </div>


        <!-- LOGIN FORM -->
        <div class="login-form-wrapper">

            <div class="login-heading">

                <span class="mobile-logo">
                    UniStudio
                </span>

                <h2>
                    Welcome back
                </h2>

                <p>
                    Enter your account details to continue.
                </p>

            </div>


            <!-- ERROR -->
            <?php if (!empty($error)): ?>

                <div class="alert alert-danger">
                    <?= $error ?>
                </div>

            <?php endif; ?>


            <?php echo form_open(base_url('login/check_login')); ?>


                <!-- USERNAME -->
                <div class="mb-3">

                    <label
                        for="username"
                        class="form-label">
                        Username
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        name="username"
                        placeholder="Enter your username"
                        required
                        autocomplete="username"
                    >

                </div>


                <!-- PASSWORD -->
                <div class="mb-3">

                    <div class="d-flex justify-content-between">

                        <label
                            for="password"
                            class="form-label">
                            Password
                        </label>

                        <a
                            href="<?= base_url('email') ?>"
                            class="forgot-link">
                            Forgot password?
                        </a>

                    </div>


                    <div class="password-wrapper">

                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="passwordToggle">
                            Show
                        </button>

                    </div>

                </div>


                <!-- REMEMBER -->
                <div class="form-check remember-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        id="remember"
                        value="1"
                    >

                    <label
                        class="form-check-label"
                        for="remember">
                        Remember me
                    </label>

                </div>


                <!-- LOGIN -->
                <button
                    type="submit"
                    class="btn btn-dark login-button">
                    Log in
                </button>


                <!-- SIGNUP MOBILE -->
                <div class="signup-mobile">

                    Don't have an account?

                    <a href="<?= base_url('signup') ?>">
                        Create an account
                    </a>

                </div>


                <!-- RESET PASSWORD -->
                <div class="login-help">

                    <span>
                        Having trouble signing in?
                    </span>

                    <a href="<?= base_url('email') ?>">
                        Reset your password
                    </a>

                </div>


            <?php echo form_close(); ?>

        </div>

    </section>

</div>


<script>
const password = document.getElementById('password');
const toggle = document.getElementById('passwordToggle');

toggle.addEventListener('click', function () {

    if (password.type === 'password') {

        password.type = 'text';
        toggle.textContent = 'Hide';

    } else {

        password.type = 'password';
        toggle.textContent = 'Show';

    }

});
</script>

</body>
</html>