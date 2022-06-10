<!doctype html>
<html>
    <head>
        <title></title>
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
        <h2>Wa List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Phone</th>
		<th>Message</th>
		<th>Secret</th>
		<th>Retry</th>
		<th>IsGroup</th>
		
            </tr><?php
            foreach ($wa_data as $wa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $wa->phone ?></td>
		      <td><?php echo $wa->message ?></td>
		      <td><?php echo $wa->secret ?></td>
		      <td><?php echo $wa->retry ?></td>
		      <td><?php echo $wa->isGroup ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>