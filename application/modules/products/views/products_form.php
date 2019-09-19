<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Products
        <small>Add a new Products</small>
        <?php echo anchor(site_url('products/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Products</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">Add</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Products <?php echo $button ?></h3>
        </div>
        <div class="box-body">
    

        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Name <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Price <?php echo form_error('price') ?></label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Quantity <?php echo form_error('quantity') ?></label>
            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity" value="<?php echo $quantity; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Date Time <?php echo form_error('date_time') ?></label>
            <input type="text" class="form-control" name="date_time" id="date_time" placeholder="Date Time" value="<?php echo $date_time; ?>" />
        </div>
	    <input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('products') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div></div></div></section></div>