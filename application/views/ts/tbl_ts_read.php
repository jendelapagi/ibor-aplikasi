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
        <h2 style="margin-top:0px">Tbl_ts Read</h2>
        <table class="table">
	    <tr><td>Nama Ts</td><td><?php echo $nama_ts; ?></td></tr>
	    <tr><td>Tempat Lahir Ts</td><td><?php echo $tempat_lahir_ts; ?></td></tr>
	    <tr><td>Tanggal Lahir Ts</td><td><?php echo $tanggal_lahir_ts; ?></td></tr>
	    <tr><td>Alamat Ts</td><td><?php echo $alamat_ts; ?></td></tr>
	    <tr><td>Pendidikan Ts</td><td><?php echo $pendidikan_ts; ?></td></tr>
	    <tr><td>No Hp Ts</td><td><?php echo $no_hp_ts; ?></td></tr>
	    <tr><td>Gol Darah Ts</td><td><?php echo $gol_darah_ts; ?></td></tr>
	    <tr><td>Id Penjadwalan</td><td><?php echo $id_penjadwalan; ?></td></tr>
	    <tr><td>Id Kunjungan</td><td><?php echo $id_kunjungan; ?></td></tr>
	    <tr><td>Id User Level</td><td><?php echo $id_user_level; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('ts') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>