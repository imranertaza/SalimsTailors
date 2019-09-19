<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Orders List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Customer Id</th>
		<th>Price</th>
		<th>Advance</th>
		<th>Delivary Date</th>
		<th>Date Time</th>
		
            </tr><?php
            foreach ($orders_data as $orders)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $orders->customer_id ?></td>
		      <td><?php echo $orders->price ?></td>
		      <td><?php echo $orders->advance ?></td>
		      <td><?php echo $orders->delivary_date ?></td>
		      <td><?php echo $orders->date_time ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>