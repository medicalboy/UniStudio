<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/header.css') ?>"
>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/footer.css') ?>"
>
<footer class="site-footer">

    <div class="container">

        <!-- MAIN FOOTER -->
        <div class="row g-4">

            <!-- BRAND -->
            <div class="col-lg-4 col-md-6">

                <a href="<?= base_url() ?>" class="footer-logo">
                    UniStudio
                </a>

                <p class="footer-description">
                    A community marketplace for discovering,
                    sharing and managing useful learning resources
                    and products.
                </p>

                <a
                    href="<?= base_url('upload') ?>"
                    class="btn btn-outline-light btn-sm">
                    Share a Product
                </a>

            </div>


            <!-- MARKETPLACE -->
            <div class="col-lg-2 col-md-6">

                <h5 class="footer-title">
                    Marketplace
                </h5>

                <ul class="footer-links">

                    <li>
                        <a href="<?= base_url('products') ?>">
                            Browse Products
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('products/fetch_detail') ?>">
                            Student Portal
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('uploader_channel') ?>">
                            Your Channel
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('upload') ?>">
                            Upload Product
                        </a>
                    </li>

                </ul>

            </div>


            <!-- ACCOUNT -->
            <div class="col-lg-2 col-md-6">

                <h5 class="footer-title">
                    Account
                </h5>

                <ul class="footer-links">

                    <?php if ($this->session->userdata('logged_in')): ?>

                        <li>
                            <a href="<?= base_url('dashboard') ?>">
                                Dashboard
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('profile') ?>">
                                Profile
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('uploader_channel') ?>">
                                Your Channel
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('login/logout') ?>">
                                Log Out
                            </a>
                        </li>

                    <?php else: ?>

                        <li>
                            <a href="<?= base_url('login') ?>">
                                Log In
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('signup') ?>">
                                Create Account
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>

            </div>


            <!-- SUPPORT -->
            <div class="col-lg-2 col-md-6">

                <h5 class="footer-title">
                    Support
                </h5>

                <ul class="footer-links">

                    <li>
                        <a href="#">
                            Help Centre
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('email') ?>">
                            Reset Password
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            Contact Us
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            Report a Problem
                        </a>
                    </li>

                </ul>

            </div>


            <!-- COMPANY -->
            <div class="col-lg-2 col-md-6">

                <h5 class="footer-title">
                    Company
                </h5>

                <ul class="footer-links">

                    <li>
                        <a href="#">
                            About UniStudio
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            Privacy
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            Terms
                        </a>
                    </li>

                </ul>

            </div>

        </div>


        <!-- BOTTOM -->
        <div class="footer-bottom">

            <div>
                &copy; 2021-<?= date('Y') ?> UniStudio.
                All rights reserved.
            </div>

            <div class="footer-bottom-links">

                <a href="#">
                    Privacy Policy
                </a>

                <a href="#">
                    Terms of Use
                </a>

                <a href="#">
                    Cookies
                </a>

            </div>

        </div>

    </div>

</footer>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>