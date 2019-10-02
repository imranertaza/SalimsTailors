<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Account Holder Transaction
        <small>List of all Account Holder</small>
        <?php echo anchor(site_url('account_holder/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Account Holder Transaction</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">List</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Balance</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <tr>
                  <td>Name</td>
                  <td><?php echo $username; ?></td>
                </tr>
                <tr>
                  <td>Phone</td>
                  <td><?php echo $phone; ?></td>
                </tr>
                <tr>
                  <td>Balance Due</td>
                   <td><?php echo $balance; ?> .TK</td>
                </tr>
                <tr>
                  <td>
                    <a href="<?php echo site_url('account_holder') ?>" class="btn btn-default">Cancel</a>
                  </td>
                </tr>
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
                <h3 class="box-title">Paid Balance Statement</h3>
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
          
        




      </div>
    </section>
</div>