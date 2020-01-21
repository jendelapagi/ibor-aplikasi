<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tbl_mitra Read</h2>
        <table class="table">
	    <tr><td>Nama Mitra</td><td><?php echo $nama_mitra; ?></td></tr>
	    <tr><td>Wilayah</td><td><?php echo $wilayah; ?></td></tr>
	    <tr><td>No Hp Mitra</td><td><?php echo $no_hp_mitra; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('miitra') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>