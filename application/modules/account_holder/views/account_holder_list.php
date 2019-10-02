<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Account Holder
        <small>List of all Account Holder</small>
        <?php echo anchor(site_url('account_holder/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Account Holder</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">List</li>
      </ol>
      
      <div class="text-right">
            <form action="<?php echo site_url('account_holder/index'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">
                        <?php 
                            if ($q <> '')
                            {
                                ?>
                                <a href="<?php echo site_url('account_holder'); ?>" class="btn btn-default">Reset</a>
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
                    <h3 class="box-title">Account Holder List</h3>
                </div>
                <div class="box-body">
                    
                    <div class="col-md-12 text-center">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                <div class="row"/>
                    <div class="col-md-12">
            
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Create Date Time</th>
                                    <th>Action</th>
                                </tr></thead><tbody><?php
                                foreach ($account_holder as $row)
                                {
                                    ?>
                                   <tr>
                                        <td width="80px"><?php echo ++$start ?></td>
                                        <td><?php echo $row->username ?></td>
                                        <td><?php echo $row->phone ?></td>
                                        <td><?php echo $row->type ?></td>
                                        <td><?php echo globalTimeStamp($row->datetime) ?></td>
                                        <td >
                                            <?php 
                                            echo anchor(site_url('account_holder/transaction/'.$row->ac_holder_id),'Transaction', 'class="btn btn-xs btn-success"'); 
                                            echo ' ';
                                            echo anchor(site_url('account_holder/read/'.$row->ac_holder_id),'View', 'class="btn btn-xs btn-info"'); 
                                            echo ' '; 
                                            echo anchor(site_url('account_holder/update/'.$row->ac_holder_id),'Update', 'class="btn btn-xs btn-warning"'); 
                                            echo ' '; 
                                            echo anchor(site_url('account_holder/delete/'.$row->ac_holder_id),'Delete', 'class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
                                        <th>Phone</th>
                                        <th>Type</th>
                                        <th>Create Date Time</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                
                            </table>
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
        </div>

</div>
</div>
</section>
</div>