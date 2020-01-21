<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_MITRA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Mitra <?php echo form_error('nama_mitra') ?></td><td><input type="text" class="form-control" name="nama_mitra" id="nama_mitra" placeholder="Nama Mitra" value="<?php echo $nama_mitra; ?>" /></td></tr>
	    <tr><td width='200'>Wilayah <?php echo form_error('wilayah') ?></td><td><input type="text" class="form-control" name="wilayah" id="wilayah" placeholder="Wilayah" value="<?php echo $wilayah; ?>" /></td></tr>

	    <tr><td width='200'>Alamat <?php echo form_error('alamat') ?></td><td><input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" /></td></tr>

	    <tr><td width='200'>No Hp Mitra <?php echo form_error('no_hp_mitra') ?></td><td><input type="text" class="form-control" name="no_hp_mitra" id="no_hp_mitra" placeholder="No Hp Mitra" value="<?php echo $no_hp_mitra; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_mitra" value="<?php echo $id_mitra; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('miitra') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>