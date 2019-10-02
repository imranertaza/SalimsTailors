<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Employes View
        <small>View of all Employes</small>
        <?php echo anchor(site_url('employes/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Employes</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">View</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">Employes Read</h3>
              </div>
              <div class="box-body">
                <table class="table">
          	     <tr><td><b>Name :</b></td><td><?php echo $name; ?></td> <td><b>Contact Number :</b></td><td><?php echo $contact_number; ?></td> <td><b>Type :</b></td><td><?php echo $type; ?></td> <td><a href="<?php echo site_url('employes') ?>" class="btn btn-warning">Back</a></td></tr>
          	     <tr><td></td></tr>
          	   </table>
            </div>
          </div>

          <div class="box">
              <div class="box-header">
                <h3 class="box-title">Date To Date Filter</h3>
              </div>
              <div class="box-body">
                <div class="col-xs-12">
                  <form action="" method="post" >
                    <div class="col-xs-4">
                      <div class="form-group">
                          <label>Start Date <?php echo form_error('Start_date') ?></label>

                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="Date" class="form-control pull-right" name="start_date" id="" value="">
                          </div>
                                      <!-- /.input group -->
                      </div>
                    </div>
                    <div class="col-xs-4">
                      <div class="form-group">
                          <label>End Date <?php echo form_error('End_date') ?></label>

                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="Date" class="form-control pull-right" name="end_date" id="" value="">
                          </div>
                                      <!-- /.input group -->
                      </div>
                    </div>
                    <div class="col-xs-4" style="margin-top: 23px;">
                      <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                  </form>
                </div>
              </div>
          </div>

      </div>
    </div>
  </section>
</div>