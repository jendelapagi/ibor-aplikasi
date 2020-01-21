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
        <h2>Tbl_ts List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Ts</th>
		<th>Tempat Lahir Ts</th>
		<th>Tanggal Lahir Ts</th>
		<th>Alamat Ts</th>
		<th>Pendidikan Ts</th>
		<th>No Hp Ts</th>
		<th>Gol Darah Ts</th>
		<th>Id Penjadwalan</th>
		<th>Id Kunjungan</th>
		<th>Id User Level</th>
		
            </tr><?php
            foreach ($ts_data as $ts)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $ts->nama_ts ?></td>
		      <td><?php echo $ts->tempat_lahir_ts ?></td>
		      <td><?php echo $ts->tanggal_lahir_ts ?></td>
		      <td><?php echo $ts->alamat_ts ?></td>
		      <td><?php echo $ts->pendidikan_ts ?></td>
		      <td><?php echo $ts->no_hp_ts ?></td>
		      <td><?php echo $ts->gol_darah_ts ?></td>
		      <td><?php echo $ts->id_penjadwalan ?></td>
		      <td><?php echo $ts->id_kunjungan ?></td>
		      <td><?php echo $ts->id_user_level ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>