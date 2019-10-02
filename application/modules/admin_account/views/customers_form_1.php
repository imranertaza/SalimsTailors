<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Customers
        <small>Add a new Customers</small>
        <?php echo anchor(site_url('customers/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Customers</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">Add</li>
      </ol>

    <section class="content">
        <form id="mesurement" action="<?php echo $action; ?>" method="post">
      <div class="row">

          <div class="col-xs-9">


              <div class="box">
                  <div class="box-header">
                      <h3 class="box-title">Customers <?php echo $button ?></h3>
                  </div>
                  <div class="box-body">
                          <table class="table table-bordered table-striped">
                          <tr>
                              <td width="100%">
                                <div class="form-group">
                                    <label for="enum">Customer Type <?php echo form_error('cus_type') ?></label>
                                    <select name="cus_type" class="form-control" onchange="show_fields(this.value);">
                                        <option <?php ($type == 'gent') ? '' : print $readonly; ?> value="gent">Gent</option>
                                        <option <?php ($type == 'lady') ? '' : print $readonly; ?> value="lady">Lady</option>
                                    </select>
                                </div>
                              </td>
                          </tr>
                          </table>
                          <div id="fields">
                          <?php print $table; ?>
                          </div>
                          <div id="all_mesurements">
                                
                          </div>
                      </form>
                  </div></div>

          </div>


        <div class="col-xs-3">


<div class="box">
        <div class="box-header">
            <h3 class="box-title">Customers <?php echo $button ?></h3>
        </div>
        <div class="box-body">


	    <div class="form-group">
            <label for="varchar">Name <?php echo form_error('name')  ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Contact Number <?php echo form_error('contact_number') ?></label>
            <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" value="<?php echo $contact_number; ?>" />
        </div>
	    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('customers') ?>" class="btn btn-default">Cancel</a>
    </div></div>

        </div>
                  	</form>
    </section>
</div>
        
        
        <script>
               function show_fields(customer_type){
                        $.ajax({
                            url: '<?php print base_url(); ?>customers/fields',
                            type: "POST",
                            dataType: "text",
                            data: {customer_type: customer_type},
                            beforeSend: function () {
                                $('#fields').html("<option>Loading...</option>");
                            },
                            success: function (msg) {
                                $('#fields').html(msg);
                            }
                        });
                }
                
                
               /*function show_order_type(customer_type){
                        $.ajax({
                            url: '<?php //print base_url(); ?>customers/order_type_list/',
                            type: "POST",
                            dataType: "text",
                            data: {customer_type: customer_type},
                            beforeSend: function () {
                                $('#order_type').html("<option>Loading...</option>");
                            },
                            success: function (msg) {
                                $('#order_type').html(msg);
                            }
                        });
                }*/
               

                function add_masurement(){
                        var frm = $('#mesurement');
                        $.ajax({
                            url: '<?php print base_url(); ?>customers/add_mesurement/',
                            type: "POST",
                            data: frm.serialize(),
                            beforeSend: function () {
                                $('#all_mesurements').html("Loading...");
                            },
                            success: function (msg) {
                                $('#all_mesurements').html(msg);
                            }
                        });
                }
                
                
        </script>