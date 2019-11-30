<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="active">
                    <a href="<?php echo base_url().'presensi/home'?>">
                        <i class="iconsminds-shop-4"></i>
                        <span>Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url().'pengguna'?>">
                        <i class="iconsminds-digital-drawing"></i> Profil
                    </a>
                </li>
                <?php
                    if($this->session->userdata('role') == 'admin'){ // Jika role-nya admin
                ?>

                <li>
                    <a href="Blank.Page.html">
                        <i class="iconsminds-air-balloon-1"></i> Admin
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url().'user/signup'?>" target="_blank">
                        <i class="iconsminds-library"></i> Registrasi
                    </a>
                </li>
                <?php
                    }
                ?>

            </ul>
        </div>
    </div>


</div>