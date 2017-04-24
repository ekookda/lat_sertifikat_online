<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/icon-user.png') ?>" class="img-circle"
                     alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $this->session->userdata('username'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MENU NAVIGATION</li>
            <?php
            $main_menu = $this->db->get_where('menu', array('parent_id' => 0));
            foreach ($main_menu->result() as $main) {
                # Query untuk mencari sub-menu
                $sub_menu = $this->db->get_where('menu', array('parent_id' => $main->id, 'tampilkan_menu'=>'tampil'));
                // periksa apakah ada sub-menu
                if ($sub_menu->num_rows() > 0) {
                    // main-menu dengan sub-menu
                    ?>
                    <li class="treeview">
                        <?php
                        echo anchor('c_Siswa/' . $main->link, '<i class="' . $main->icon . '"></i> ' . ucwords($main->nama_menu) . ' <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span>');

                        # Sub-menu disini
                        ?>
                        <ul class="treeview-menu">
                            <?php
                            $admin = 'c_admin';
                            $siswa = 'c_siswa';

                            if ($this->session->userdata('akses') == 'admin') {
                                echo "<li>";
                                echo anchor($admin.'/data_siswa', '<i class="fa fa-file-o"></i> Data Siswa');
                                echo "</li>";
                            }
                            foreach ($sub_menu->result() as $sub) {
                                echo "<li>";
                                if ($this->session->userdata('akses') == 'admin') {
                                    echo anchor($admin.'/' . $sub->link, '<i class="' . $sub->icon . '"></i> ' . ucwords($sub->nama_menu));
                                } else {
                                    echo anchor($siswa.'/' . $sub->link, '<i class="' . $sub->icon . '"></i> ' . ucwords($sub->nama_menu));
                                }
                                echo "</li>";
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                } else {
                    echo "<li>";
                    echo anchor('c_Siswa/' . $main->link, '<i class="' . $main->icon . '"></i> ' . ucwords($main->nama_menu));
                    echo "</li>";
                }
            }
            ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">