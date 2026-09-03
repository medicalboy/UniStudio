<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create Account | UniStudio</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/signup.css') ?>"
    >
</head>

<body>

<div class="signup-page">

    <!-- LEFT SIDE -->
    <section class="signup-brand">

        <a href="<?= base_url() ?>" class="brand-logo">
            UniStudio
        </a>

        <div class="brand-content">

            <span class="brand-label">
                Join UniStudio
            </span>

            <h1>
                Learn, share and grow with your community.
            </h1>

            <p class="brand-description">
                Create your free account to discover learning resources,
                upload products and build your own channel.
            </p>


            <div class="benefit-list">

                <div class="benefit-item">

                    <div class="benefit-icon">
                        ✓
                    </div>

                    <div>
                        <strong>Discover resources</strong>

                        <p>
                            Browse products and learning content
                            shared by the community.
                        </p>
                    </div>

                </div>


                <div class="benefit-item">

                    <div class="benefit-icon">
                        ✓
                    </div>

                    <div>
                        <strong>Build your channel</strong>

                        <p>
                            Upload your own products and manage
                            your personal creator channel.
                        </p>
                    </div>

                </div>


                <div class="benefit-item">

                    <div class="benefit-icon">
                        ✓
                    </div>

                    <div>
                        <strong>Connect with others</strong>

                        <p>
                            Comment, review and interact with
                            tutors and students.
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
    <section class="signup-form-section">

        <div class="signup-top">

            <span>
                Already have an account?
            </span>

            <a
                href="<?= base_url('login') ?>"
                class="btn btn-outline-dark">
                Log in
            </a>

        </div>


        <div class="signup-form-wrapper">

            <div class="signup-heading">

                <span class="mobile-logo">
                    UniStudio
                </span>

                <h2>
                    Create your account
                </h2>

                <p>
                    Start using UniStudio for free.
                </p>

            </div>


            <?php if (!empty($error)): ?>

                <div class="alert alert-danger">
                    <?= $error ?>
                </div>

            <?php endif; ?>


            <?php echo form_open(base_url('signup/do_signup')); ?>


                <!-- NAME -->
                <div class="mb-3">

                    <label
                        for="fullname"
                        class="form-label">
                        Username
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="fullname"
                        name="fullname"
                        placeholder="Choose a username"
                        required
                    >

                </div>


                <!-- EMAIL -->
                <div class="mb-3">

                    <label
                        for="email"
                        class="form-label">
                        Email address
                    </label>

                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="name@example.com"
                        required
                    >

                </div>


                <!-- PASSWORD -->
                <div class="mb-2">

                    <label
                        for="password"
                        class="form-label">
                        Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Create a password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="passwordToggle">
                            Show
                        </button>

                    </div>

                </div>


                <!-- PASSWORD HELP -->
                <div class="password-help">

                    <span>
                        Your password must contain:
                    </span>

                    <ul>
                        <li>At least 8 characters</li>
                        <li>At least one uppercase letter</li>
                        <li>At least one lowercase letter</li>
                        <li>At least one number</li>
                    </ul>

                </div>


                <!-- TERMS -->
                <div class="form-check terms-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="terms"
                        required
                    >

                    <label
                        class="form-check-label"
                        for="terms">

                        I agree to the
                        <a href="#">Terms of Use</a>
                        and
                        <a href="#">Privacy Policy</a>.

                    </label>

                </div>


                <!-- SUBMIT -->
                <button
                    type="submit"
                    class="btn btn-dark signup-button">
                    Create account
                </button>


                <div class="login-mobile">

                    Already have an account?

                    <a href="<?= base_url('login') ?>">
                        Log in
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