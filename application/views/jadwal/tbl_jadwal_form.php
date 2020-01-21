<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_JADWAL</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Tanggal Rencana Kunjungan <?php echo form_error('tanggal_rencana_kunjungan') ?></td><td><input type="date" class="form-control" name="tanggal_rencana_kunjungan" id="tanggal_rencana_kunjungan" placeholder="Tanggal Rencana Kunjungan" value="<?php echo $tanggal_rencana_kunjungan; ?>" /></td></tr>
	    	    <tr><td width='200'> Nama Mitra <?php echo form_error('id_mitra') ?></td>
	    	<td><?php echo cmb_dinamis('id_mitra', 'tbl_mitra', 'nama_mitra', 'id_mitra') ?></td> </tr>
	    <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_penjadwalan" value="<?php echo $id_penjadwalan; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('jadwal') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>