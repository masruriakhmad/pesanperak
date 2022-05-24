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
        <h2>User_menu_access List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Menu</th>
		<th>Id Group</th>
		
            </tr><?php
            foreach ($user_menu_access_data as $user_menu_access)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $user_menu_access->id_menu ?></td>
		      <td><?php echo $user_menu_access->id_group ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>