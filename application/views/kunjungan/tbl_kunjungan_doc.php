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
        <h2>Tbl_kunjungan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Tanggal Kunjungan</th>
		<th>Id Mitra</th>
		<th>Keterangan</th>
		<th>Foto Kunjungan</th>
		
            </tr><?php
            foreach ($kunjungan_data as $kunjungan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kunjungan->tanggal_kunjungan ?></td>
		      <td><?php echo $kunjungan->id_mitra ?></td>
		      <td><?php echo $kunjungan->keterangan ?></td>
		      <td><?php echo $kunjungan->foto_kunjungan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>