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
        <h2>Tbl_jadwal List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Tanggal Rencana Kunjungan</th>
		<th>Id Mitra</th>
		<th>Keterangan</th>
		
            </tr><?php
            foreach ($jadwal_data as $jadwal)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $jadwal->tanggal_rencana_kunjungan ?></td>
		      <td><?php echo $jadwal->id_mitra ?></td>
		      <td><?php echo $jadwal->keterangan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>