<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this->config->config["pageTitle"] ?></title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/font/simple-line-icons/css/simple-line-icons.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/bootstrap.rtl.only.min.css" />
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/fullcalendar.min.css" /> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/datatables.responsive.bootstrap4.min.css" />
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/select2.min.css" /> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/perfect-scrollbar.css" />
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/owl.carousel.min.css" /> -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/bootstrap-stars.css" /> -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/nouislider.min.css" /> -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/bootstrap-datepicker3.min.css" /> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/component-custom-switch.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/main.css" />
    <!-- </style> -->
    <script>
        var base_url = '<?= base_url() ?>' // Buat variabel base_url agar bisa di akses di semua file js
    </script>
</head>

<body id="app-container" class="menu-default show-spinner">
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>

            <div class="search">
                <input placeholder="Search..." name="search_mhs" id="search_mhs">
                <span class="search-icon">
                    <i class="simple-icon-magnifier"></i>
                </span>
            </div>


        </div>


        <a class="navbar-logo" href="<?php echo base_url() ?>assets/dore/Dashboard.Default.html">

        </a>

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
                <div class="position-relative d-none d-sm-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-grid"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
                        <a href="" class="icon-menu-item">
                            <i class="iconsminds-equalizer d-block"></i>
                            <span>Settings</span>
                        </a>

                        <a href="" class="icon-menu-item">
                            <i class="iconsminds-male-female d-block"></i>
                            <span>Users</span>
                        </a>

                        <a href="" class="icon-menu-item">
                            <i class="iconsminds-puzzle d-block"></i>
                            <span>Components</span>
                        </a>

                        <a href="" class="icon-menu-item">
                            <i class="iconsminds-bar-chart-4 d-block"></i>
                            <span>Profits</span>
                        </a>

                        <a href="" class="icon-menu-item">
                            <i class="iconsminds-file d-block"></i>
                            <span>Surveys</span>
                        </a>

                        <a href="" class="icon-menu-item">
                            <i class="iconsminds-suitcase d-block"></i>
                            <span>Tasks</span>
                        </a>

                    </div>
                </div>


            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="name"><?php echo $this->session->userdata('nama') ?></span>
                    <span>
                        <!--                        <img alt="Profile Picture" src="" />-->
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item" href="">Account</a>
                    <a class="dropdown-item" href="">Features</a>
                    <a class="dropdown-item" href="">History</a>
                    <a class="dropdown-item" href="">Support</a>
                    <a class="dropdown-item" href="<?php echo base_url() . 'auth/logout' ?>">Sign out</a>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Dashboard</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Library</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>