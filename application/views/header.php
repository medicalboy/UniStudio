<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UniStudio</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/header.css') ?>"
    >

</head>

<body>

<header>

    <!-- TOP BAR -->
    <div class="top-bar">

        <div class="container">

            <div class="d-flex justify-content-between align-items-center">

                <span>
                    Learn smarter with UniStudio
                </span>

                <div class="top-links">

                    <a href="<?= base_url('dashboard') ?>">
                        Dashboard
                    </a>

                    <a href="<?= base_url('uploader_channel') ?>">
                        Your Channel
                    </a>

                    <a href="<?= base_url('profile') ?>">
                        Account
                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- MAIN HEADER -->
    <div class="main-header">

        <div class="container">

            <div class="header-layout">

                <!-- LOGO -->
                <a
                    href="<?= base_url() ?>"
                    class="site-logo">

                    UniStudio

                </a>


                <!-- SEARCH -->
                <form
                    method="get"
                    action="<?= base_url('products/search') ?>"
                    class="header-search">

                    <input
                        type="text"
                        name="q"
                        placeholder="Search products, courses and resources..."
                        value="<?= html_escape($this->input->get('q') ?? '') ?>"
                    >

                    <button type="submit">
                        Search
                    </button>

                </form>


                <!-- ACCOUNT -->
                <div class="header-actions">

                    <?php if ($this->session->userdata('logged_in')): ?>

                        <div class="dropdown">

                            <button
                                class="account-button dropdown-toggle"
                                type="button"
                                id="accountMenu"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                                <span class="account-icon">
                                    <?= strtoupper(
                                        substr(
                                            $this->session->userdata('username') ?? 'U',
                                            0,
                                            1
                                        )
                                    ) ?>
                                </span>

                                <span class="account-text">

                                    <small>
                                        Hello
                                    </small>

                                    <strong>
                                        <?= html_escape(
                                            $this->session->userdata('username')
                                        ) ?>
                                    </strong>

                                </span>

                            </button>


                            <ul
                                class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="accountMenu">

                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="<?= base_url('dashboard') ?>">

                                        Dashboard

                                    </a>

                                </li>

                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="<?= base_url('profile') ?>">

                                        Profile

                                    </a>

                                </li>

                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="<?= base_url('uploader_channel') ?>">

                                        Your Channel

                                    </a>

                                </li>

                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="<?= base_url('upload') ?>">

                                        Upload Product

                                    </a>

                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>

                                    <a
                                        class="dropdown-item text-danger"
                                        href="<?= base_url('login/logout') ?>">

                                        Log out

                                    </a>

                                </li>

                            </ul>

                        </div>

                    <?php else: ?>

                        <a
                            href="<?= base_url('login') ?>"
                            class="login-link">

                            Login

                        </a>

                        <a
                            href="<?= base_url('signup') ?>"
                            class="signup-button">

                            Sign Up

                        </a>

                    <?php endif; ?>


                    <a
                        href="<?= base_url('cart') ?>"
                        class="cart-button">

                        🛒

                        <span>
                            Cart
                        </span>

                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- NAVIGATION -->
    <nav class="category-nav">

        <div class="container">

            <div class="category-links">

                <a href="<?= base_url() ?>">
                    Home
                </a>

                <a href="<?= base_url('products') ?>">
                    Products
                </a>

                <a href="<?= base_url('uploader_channel') ?>">
                    Tutor Channel
                </a>

                <a href="<?= base_url('products/fetch_detail') ?>">
                    Student Portal
                </a>

                <a href="<?= base_url('upload') ?>">
                    Sell / Upload
                </a>

                <a href="<?= base_url('dashboard') ?>">
                    Dashboard
                </a>

            </div>

        </div>

    </nav>

</header>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
</script>
