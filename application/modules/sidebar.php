<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php print base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Syed Ibrahim Erteza</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Working</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php                                                                    
            echo add_main_menu('New Order', 'orders', 'orders', 'fa fa-medkit');
            echo add_main_menu('Repeat Order', 'orders', 'orders', 'fa fa-medkit');
            echo add_main_menu('Customer', 'customers', 'customers', 'fa fa-cubes');
            echo add_main_menu('Settings', 'settings', 'settings', 'fa fa-gears');
           ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>