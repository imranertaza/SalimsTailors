<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Assign Orders View
        <small>View of all Assign Orders</small>
        <?php echo anchor(site_url('assign_orders/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Assign Orders</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">View</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Assign Orders Read</h3>
        </div>
        <div class="box-body">
        
        <table class="table">
	    <tr><td>Employe</td><td><?php echo get_name_by_id('name','employes','employes_id',$employes_id) ; ?></td></tr>
	    <tr><td>Order ID</td><td><?php echo $order_id; ?></td></tr>
	    <tr><td>Delivary Date</td><td><?php echo $delivary_date; ?></td></tr>
	    <tr><td>Assign Date Time</td><td><?php echo globalTimeStamp($date_time); ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('assign_orders') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table></div></div></div></div></section></div>