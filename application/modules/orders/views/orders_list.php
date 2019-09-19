<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Orders List
        <small>List of all Orders</small>
        <?php echo anchor(site_url('orders/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Orders</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">List</li>
      </ol>
      
      <div class="text-right">
            <form action="<?php echo site_url('orders/index'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">
                        <?php 
                            if ($q <> '')
                            {
                                ?>
                                <a href="<?php echo site_url('orders'); ?>" class="btn btn-default">Reset</a>
                                <?php
                            }
                        ?>
                      <button class="btn btn-primary" type="submit">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </section>

    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Orders List</h3>
        </div>
        <div class="box-body">
            
            <div class="col-md-8 text-center">
                <div style="margin-top: 12px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        <div class="row"/>
        <div class="col-md-12">
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
		<th>Customer Id</th>
		<th>Price</th>
		<th>Advance</th>
		<th>Delivary Date</th>
		<th>Date Time</th>
		<th>Action</th>
            </tr></thead><tbody><?php
            foreach ($orders_data as $orders)
            {
                ?>
               <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $orders->customer_id ?></td>
			<td><?php echo $orders->price ?></td>
			<td><?php echo $orders->advance ?></td>
			<td><?php echo $orders->delivary_date ?></td>
			<td><?php echo $orders->date_time ?></td>
			<td width="180px">
				<?php 
				echo anchor(site_url('orders/read/'.$orders->order_id),'View', 'class="btn btn-xs btn-info"'); 
				echo ' '; 
				echo anchor(site_url('orders/update/'.$orders->order_id),'Update', 'class="btn btn-xs btn-warning"'); 
				echo ' '; 
				echo anchor(site_url('orders/delete/'.$orders->order_id),'Delete', 'class="btn btn-xs btn-danger"', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
            </tbody>
            
            <tfoot>
            <tr>
                <th>No</th>
		<th>Customer Id</th>
		<th>Price</th>
		<th>Advance</th>
		<th>Delivary Date</th>
		<th>Date Time</th>
		<th>Action</th>
            </tr></tfoot>
            
        </table>
        </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('orders/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('orders/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
</div>
</div>
</div>
</section>
</div>