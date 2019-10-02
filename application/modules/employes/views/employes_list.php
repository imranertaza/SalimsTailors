<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Employes List
        <small>List of all Employes</small>
        <?php echo anchor(site_url('employes/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Employes</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">List</li>
      </ol>
      
      <div class="text-right">
            <form action="<?php echo site_url('employes/index'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">
                        <?php 
                            if ($q <> '')
                            {
                                ?>
                                <a href="<?php echo site_url('employes'); ?>" class="btn btn-default">Reset</a>
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
            <h3 class="box-title">Employes List</h3>
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
		<th>Name</th>
		<th>Contact Number</th>
		<th>Type</th>
		<th>Action</th>
            </tr></thead><tbody><?php
            foreach ($employes_data as $employes)
            {
                ?>
               <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $employes->name ?></td>
			<td><?php echo $employes->phone ?></td>
			<td><?php echo $employes->type ?></td>
			<td width="200px">
				<?php 
                
				echo anchor(site_url('employes/read/'.$employes->employes_id),'View', 'class="btn btn-xs btn-info"'); 
				echo ' '; 
				echo anchor(site_url('employes/update/'.$employes->employes_id),'Update', 'class="btn btn-xs btn-warning"'); 
				echo ' '; 
				echo anchor(site_url('employes/delete/'.$employes->employes_id),'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')" class="btn btn-xs btn-danger"'); 
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
		<th>Name</th>
		<th>Contact Number</th>
		<th>Type</th>
		<th>Action</th>
            </tr></tfoot>
            
        </table>
        </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('employes/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('employes/word'), 'Word', 'class="btn btn-primary"'); ?>
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