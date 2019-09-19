<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Orders View
        <small>View of all Orders</small>
        <?php echo anchor(site_url('orders/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Orders</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">View</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Orders Read</h3>
        </div>
        <div class="box-body">
        
        <table class="table">
	    <tr><td>Customer Id</td><td><?php echo $customer_id; ?></td></tr>
	    <tr><td>Price</td><td><?php echo $price; ?></td></tr>
	    <tr><td>Advance</td><td><?php echo $advance; ?></td></tr>
	    <tr><td>Delivary Date</td><td><?php echo $delivary_date; ?></td></tr>
	    <tr><td>Date Time</td><td><?php echo $date_time; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('orders') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table></div></div></div></div></section></div>