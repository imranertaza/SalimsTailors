<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Account Holder
        <small>List of all Account Holder</small>
        <?php echo anchor(site_url('account_holder/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Account Holder</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">Add</li>
      </ol>

    <section class="content">
        <form id="" action="<?php echo $action; ?>" method="post">
          <div class="row">


            <div class="col-xs-12">

              <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Account Holder <?php echo $button ?></h3>
                  </div>
                  <div class="box-body ">
                    <div class="col-xs-6">
                	    <div class="form-group">
                          <label for="varchar">User Name <?php echo form_error('name')  ?></label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name ?>" />
                      </div>
                	    <div class="form-group">
                          <label for="int">Password <?php echo form_error('password') ?></label>
                          <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" />
                      </div>
                      <div class="form-group">
                          <label for="int">Contact Number <?php echo form_error('phone') ?></label>
                          <input type="text" class="form-control" name="phone" id="phone" placeholder="Contact Number" value="<?php echo $phone ?>" />
                      </div>
                      <div class="form-group">
                          <label for="varchar">Type <?php echo form_error('type')  ?></label>
                          <input type="text" class="form-control" name="type" id="type" placeholder="type" value="<?php echo $type ?>" />
                          <input type="hidden" class="form-control" name="ac_holder_id" id="ac_holder_id"  value="<?php echo $ac_holder_id ?>" />
                      </div>
                	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                	    <a href="<?php echo site_url('account_holder') ?>" class="btn btn-default">Cancel</a>
                    </div>
                  </div>
                  <div class="col-xs-6"></div>

                </div>

               </div>


            </div>        	
          </form>
        </section>
    </section>
</div>
        
        
        