<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Assign Orders
        <small>Add a new Orders</small>
        <?php echo anchor(site_url('assign_orders/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Assign Orders</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">Add</li>
      </ol>
    </section>

    <section class="content">
      <form id="" action="<?php echo $action; ?>" method="post">
        <div class="row">

          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                  <h3 class="box-title">Assign Orders </h3>
              </div>
          
              <div class="box-body">
                  <div class="col-xs-6" >
                    <div class="form-group">
                      <div class="col-xs-12">
                          <label for="enum">Employe</label>
                          <select name="employes_id" class="form-control" >
                              <option value="">Please Select</option>
                              <?php foreach ($employe as $row) { ?>
                              <option value="<?php echo $row->employes_id;?>"><?php echo $row->name;?></option>
                              <?php } ?>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <label for="varchar">Product Type<?php echo form_error('type')  ?></label>
                        <select name="pro_id" class="form-control" >
                              <option value="">Please Select</option>
                              <?php foreach ($pro_type as $row) { ?>
                              <option value="<?php echo $row->pro_id;?>"><?php echo $row->name;?></option>
                              <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <label for="varchar">Order Id <?php echo form_error('type')  ?></label>
                        <div class="order">
                          <div class="col-xs-8">
                            <input type="text" class="form-control" name="order_id[]" placeholder="Input Order Id" />
                          </div>
                          <div class="col-xs-2" style="margin-top: 6px;">
                            <a href="javascript:void(0);"  type="button" class="add_button btn-primary btn-sm" title="Add field"><i class="fa fa-plus"></i></a>
                          </div><br><br>
                        </div>
                        <span class="field_wrapper"></span>
                      </div>
                        
                    </div>

                    <div class="form-group">
                      <div class="col-xs-12">
                        <label>Delivary Date <?php echo form_error('delivary_date') ?></label>

                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" name="delivary_date" id="datepicker" value="">
                        </div>
                      </div>
                                    <!-- /.input group -->
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="box-header">
                      <h3 class="box-title">Alter </h3>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                          <label for="enum">Name</label>
                          <input type="" name="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <label for="varchar">Product Type<?php echo form_error('type')  ?></label>
                        <select name="pro_id" class="form-control" >
                              <option value="">Please Select</option>
                              <?php foreach ($pro_type as $row) { ?>
                              <option value="<?php echo $row->pro_id;?>"><?php echo $row->name;?></option>
                              <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                          <label for="enum">Quantity</label>
                          <input type="" name="" class="form-control">
                        </div>
                    </div>
                  </div>
                  <div class="col-xs-12" style="margin-top: 20px; margin-left: 16px; ">
                      <button type="submit" class="btn btn-primary">Create</button> 
                      <a href="<?php echo site_url('assign_orders') ?>" class="btn btn-default">Cancel</a> 
                  </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
  
</div>
        

        