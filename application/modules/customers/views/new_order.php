<div class="content-wrapper">
    <section class="content-header">
      	<h1>
        	Customers
        	<small>Customers</small>
        	<?php echo anchor(site_url('customers/create'),'+ Add', 'class="btn btn-primary"'); ?>
      	</h1>
      	<ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Customers</a></li>
        	<!--<li><a href="#">List</a></li>-->
        	<li class="active">Order</li>
      	</ol>
    </section>
     <section class="content">
		<div class="row">
		    <div class="col-xs-12">
			    <div class="box">
			        <div class="box-header">
			            <h3 class="box-title">Orders Create</h3>
			        </div>
			        <div class="box-body">
			        	<form action="" method="post">
				        	<div class="col-xs-9">
						        <div class="box">
							        <div class="box-header">
							            <h3 class="box-title">Orders Create</h3>
							        </div>
							        <div class="box-body">
							        	<div class="product-type" >
								        	<table class="table table-bordered table-striped">
								        		<tbody>
								        			<tr>
								        				<?php foreach ($product_type as $value) { ?>
								        				<td>
								        					<label>
								        						<input type="checkbox" value="<?php echo $value->pro_id; ?>"> <?php echo $value->name; ?>
								        					</label>
								        				</td>
								        				<?php } ?>
								        			</tr>
								        		</tbody>
								        	</table>
							        	</div>
							        	<div class="product-detail" >
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
							</div>

				        	<div class="col-xs-3">
					             <div class="box">
					                <div class="box-header">
					                    <h3 class="box-title">Order Create</h3>
					                </div>
					                <?php foreach ($customer as $value) { ?>  
					                <div class="box-body">
						                <div class="form-group">
						                    <label for="varchar">Name <?php echo form_error('name')  ?></label>
						                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $value->name; ?>" />
						                </div>
						                    <div class="form-group">
						                    <label for="int">Contact Number <?php echo form_error('contact_number') ?></label>
						                    <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" value="<?php echo $value->contact_number; ?>" />
						                </div>
						                    <div class="form-group">
						                    <label for="int">Price <?php echo form_error('price') ?></label>
						                    <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="" />
						                </div>
						                <div class="form-group">
						                    <label for="int">Advance <?php echo form_error('advance') ?></label>
						                    <input type="text" class="form-control" name="advance" id="advance" placeholder="Advance" value="" />
						                </div>
						                <div class="form-group">
						                    <label for="int">Due <?php echo form_error('Due') ?></label>
						                    <input type="text" class="form-control" name="due" id="advance" placeholder="Due" value="" />
						                </div>
						                <div class="form-group">
						                    <label>Delivary Date <?php echo form_error('delivary_date') ?></label>

						                    <div class="input-group date">
						                        <div class="input-group-addon">
						                            <i class="fa fa-calendar"></i>
						                        </div>
						                        <input type="text" class="form-control pull-right" name="delivary_date" id="datepicker" value="">
						                    </div>
						                        <!-- /.input group -->
						                </div>
						                <input type="hidden" name="customer_id" value="<?php echo $value->customer_id; ?>" /> 
						                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
					              	</div>
					              	<?php }?>
					            </div>
					        </div>
				        </form>
			            

			        </div>
			    </div>
			</div>
		</div>
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

