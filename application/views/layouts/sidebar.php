<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">


                <?php
                if ($this->session->userdata('role') == 'm') { // Jika role-nya admin
                ?>
                    <li class="active">
                        <a href="<?php echo base_url() . 'presensi/home' ?>">
                            <i class="iconsminds-shop-4"></i>
                            <span>Dashboards</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url() . 'jadwal/index' ?>">
                            <i class="iconsminds-digital-drawing"></i>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="#applications">
                            <i class="iconsminds-air-balloon-1"></i> Admin
                        </a>
                    </li>
                    <li>
                        <a href="#laporans">
                            <i class="iconsminds-air-balloon-1"></i> Laporan
                        </a>
                    </li>
                <?php
                }
                ?>

                <?php
                if ($this->session->userdata('role') == 'mh') { // Jika role-nya admin
                ?>
                    <li class="active">
                        <a href="<?php echo base_url() . 'presensi/absen' ?>">
                            <i class="iconsminds-shop-4"></i>
                            <span>Dashboards</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url() . 'jadwal/index' ?>">
                            <i class="iconsminds-digital-drawing"></i>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() . 'auth/logout' ?>">
                            <i class="iconsminds-library"></i> Logout
                        </a>
                    </li>
                <?php
                }
                ?>
                <?php if ($this->session->userdata('role') == 'd') { // Jika role-nya admin
                ?>
                    <li class="active">
                        <a href="<?php echo base_url() . 'presensi/home' ?>">
                            <i class="iconsminds-shop-4"></i>
                            <span>Dashboards</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url() . 'jadwal/index' ?>">
                            <i class="iconsminds-digital-drawing"></i>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() . 'jadwal/index' ?>">
                            <i class="iconsminds-digital-drawing"></i>
                            <span>Rekap</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() . 'auth/logout' ?>">
                            <i class="iconsminds-library"></i> Logout
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="applications">
                <li>
                    <a href="<?php echo base_url() . 'user/signup' ?>">
                        <i class="iconsminds-library"></i> Registrasi
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'pengguna' ?>">
                        <i class="iconsminds-digital-drawing"></i> Pengguna
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'kelas' ?>">
                        <i class="iconsminds-digital-drawing"></i> Kelas
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="laporans">
                <li>
                    <a href="<?php echo base_url() . 'laporan/pertemuan' ?>">
                        <i class="iconsminds-library"></i> Pertemuan
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'laporan/rekap' ?>">
                        <i class="iconsminds-digital-drawing"></i> Rekap Absen
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>


</div>