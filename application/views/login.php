<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $this->config->config["pageTitle"] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/font/simple-line-icons/css/simple-line-icons.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/bootstrap.rtl.only.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/fullcalendar.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/datatables.responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/bootstrap-stars.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/nouislider.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/vendor/component-custom-switch.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dore/css/main.css" />
</head>

<body class="background show-spinner">
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">

                        </div>
                        <div class="form-side">
                            <a href="#">
                                <h3>SISTEM INFORMASI ABSENSI & PRESENSI (SIAP)</h3>
                                <p>STT Indonesia Tanjungpinang</p>
                            </a>
                            <h6 class="mb-4">Login</h6>
                            <form action="<?php echo base_url() . 'auth/login' ?>" method="post">
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" name="username" />
                                    <span>Username</span>
                                </label>

                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="password" placeholder="" name="password" />
                                    <span>Password</span>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                                </div>
                                <br>
                                <div class="d-flex justify-content-between align-items-center">
                                    <?php if ($this->session->flashdata('message')) : ?>
                                        <?php if ($this->session->flashdata('message') == true) : ?>
                                            <div class="alert alert-danger alert-dismissible fade show rounded mb-0" role="alert">
                                                <strong>Peringatan !</strong> <?= $this->session->flashdata('message') ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/chartjs-plugin-datalabels.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/fullcalendar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/datatables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/owl.carousel.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/progressbar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/jquery.barrating.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/select2.full.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/nouislider.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/Sortable.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/vendor/mousetrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/dore.script.js"></script>
    <script src="<?php echo base_url() ?>assets/dore/js/scripts.js"></script>
</body>
</html>