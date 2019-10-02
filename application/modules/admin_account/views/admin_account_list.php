<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Admin List
        <small>List of all Admin</small>
        <?php echo anchor(site_url('admin_account/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">List</li>
      </ol>
      
      <div class="text-right">
            <form action="<?php echo site_url('admin_account/index'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">
                        <?php 
                            if ($q <> '')
                            {
                                ?>
                                <a href="<?php echo site_url('admin_account'); ?>" class="btn btn-default">Reset</a>
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
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            <div class="col-xs-8">
                <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Admin Balance</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <?php foreach ($admin_account as $row) { ?>
                                <tr>
                                    <td>Name</td>
                                    <td><?php echo $row->username?></td>
                                </tr>
                                <tr>
                                    <td>Balance</td>
                                    <td><?php echo $row->balance?> .TK</td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                </div>
                <div class="col-xs-6" >
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Get Balance Statement</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Purpose</th>
                                    <th>Amount</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Purpose</td>
                                    <td>Amount .TK</td>
                                    <td>Date Time </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
                <div class="col-xs-6" >
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Cost Balance Statement</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Purpose</th>
                                    <th>Amount</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Purpose</td>
                                    <td>Amount .TK</td>
                                    <th>Date Time</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>


            <div class="col-xs-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Get Balance </h3>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo site_url('admin_account/get_balance') ?>" method="post" >
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="varchar">Account Holder <?php echo form_error('purpose')  ?></label>
                                    <input type="text" onkeypress="findResult()" class="form-control" name="name" id="name" placeholder="Search name..." value="" />
                                    <b id="result"></b>
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Purpose <?php echo form_error('purpose')  ?></label>
                                    <input type="text" class="form-control" name="purpose" id="purpose" placeholder="Purpose"/>
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Amount <?php echo form_error('amount')  ?></label>
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount"/>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button> 
                                        
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Cost Balance </h3>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo site_url('admin_account/cost_balance') ?>" method="post" >
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="varchar">Account Holder <?php echo form_error('purpose')  ?></label>
                                    <input type="text" onkeypress="Result()" class="form-control" name="username" id="holdername" placeholder="Search name..." value="" />
                                    <b id="find"></b>
                                </div>

                                <div class="form-group">
                                    <label for="varchar">Purpose <?php echo form_error('purpose')  ?></label>
                                    <input type="text" class="form-control" name="purpose" id="purpose" placeholder="Purpose"/>
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Amount <?php echo form_error('amount')  ?></label>
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount"/>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button> 
                                        
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
 function addText(Textval){
    $('#name').val(Textval);
    $('#result').empty();
  }
 
  function findResult(){

    $('#name').on('keyup',function(){

      var search_text = $('#name').val();

      if(search_text==""){
            $('#result').empty();
        }else{
            $.ajax({
              type: "POST",
              url: "<?php echo site_url('admin_account/search_name') ?>", 
              data: {search_name: search_text}, 
              success: function(html){
                console.log(html); 
                $("#result").html(html).show(); 
              }
            });
        }
      });
  }
  //

  function onText(Textval){
    $('#holdername').val(Textval);
    $('#find').empty();
  }
  function Result(){
       $('#holdername').on('keyup',function(){

      var search = $('#holdername').val();

      if(search==""){
            $('#find').empty();
        }else{
            $.ajax({
              type: "POST",
              url: "<?php echo site_url('admin_account/liveSearch') ?>", 
              data: {search_name: search}, 
              success: function(html){
                console.log(html); 
                $("#find").html(html).show(); 
              }
            });
        }
      });
    }
</script>
