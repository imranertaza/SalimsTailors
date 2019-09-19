<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Orders
        <small>Add a new Orders</small>
        <?php echo anchor(site_url('orders/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Orders</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">Add</li>
      </ol>
      

    <section class="content">
      <form id="mesurement" action="<?php echo $action; ?>" method="post">
      <div class="row">

          <div class="col-xs-9">
        
    
        <div class="box">
        <div class="box-header">
            <h3 class="box-title">Orders <?php echo $button ?></h3>
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
        </div>
        </div>
        </div>
          
          <div class="col-xs-3">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Order <?php echo $button ?></h3>
                </div>
                  
                <div class="box-body">
                <div class="form-group">
                    <label for="varchar">Name <?php echo form_error('name')  ?></label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php //echo $name; ?>" />
                </div>
                    <div class="form-group">
                    <label for="int">Contact Number <?php echo form_error('contact_number') ?></label>
                    <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" value="<?php //echo $contact_number; ?>" />
                </div>
                    <div class="form-group">
                    <label for="int">Price <?php echo form_error('price') ?></label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>" />
                </div>
                    <div class="form-group">
                    <label for="int">Advance <?php echo form_error('advance') ?></label>
                    <input type="text" class="form-control" name="advance" id="advance" placeholder="Advance" value="<?php echo $advance; ?>" />
                </div>
                    <div class="form-group">
                        <label>Delivary Date <?php echo form_error('delivary_date') ?></label>

                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" name="delivary_date" id="datepicker" value="<?php echo $delivary_date; ?>">
                        </div>
                        <!-- /.input group -->
                      </div>
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" /> 
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <a href="<?php echo site_url('orders') ?>" class="btn btn-default">Cancel</a>
              </div>
              </div>
          </div>
          
          </section></div>
        
        
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
        