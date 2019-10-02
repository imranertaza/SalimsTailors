<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Employes
        <small>Add a new Employes</small>
        <?php echo anchor(site_url('employes/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Employes</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">Add</li>
      </ol>

    <section class="content">
        <form id="" action="<?php echo $action; ?>" method="post">
          <div class="row">


            <div class="col-xs-12">

              <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Employes <?php echo $button ?></h3>
                  </div>
                  <div class="box-body ">
              	    <div class="form-group">
                        <label for="varchar">Name <?php echo form_error('name')  ?></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name ?>" />
                    </div>
              	    <div class="form-group">
                        <label for="int">Employes Number <?php echo form_error('contact_number') ?></label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Contact Number" value="<?php echo $phone ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Employes Type <?php echo form_error('type')  ?></label>
                        <input type="text" class="form-control" name="type" id="type" placeholder="type" value="<?php echo $type ?>" />
                        <input type="hidden" class="form-control" name="employes_id" id="employes_id" value="<?php echo $employes_id; ?>" />
                    </div>
              	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
              	    <a href="<?php echo site_url('employes') ?>" class="btn btn-default">Cancel</a>
                  </div>
                </div>

               </div>


            </div>        	
          </form>
        </section>
    </section>
</div>
        
        
        