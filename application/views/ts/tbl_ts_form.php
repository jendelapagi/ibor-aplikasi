<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_TS</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Ts <?php echo form_error('nama_ts') ?></td>
	    	<td><input type="text" class="form-control" name="nama_ts" id="nama_ts" placeholder="Nama Ts" value="<?php echo $nama_ts; ?>" />
	    	</td>
	    </tr>
	    <tr><td width='200'>Tempat Lahir Ts <?php echo form_error('tempat_lahir_ts') ?></td>
	    	<td><input type="text" class="form-control" name="tempat_lahir_ts" id="tempat_lahir_ts" placeholder="Tempat Lahir Ts" value="<?php echo $tempat_lahir_ts; ?>" />
	    	</td>
	    </tr>
	    <tr><td width='200'>Tanggal Lahir Ts <?php echo form_error('tanggal_lahir_ts') ?></td>
	    	<td><input type="date" class="form-control" name="tanggal_lahir_ts" id="tanggal_lahir_ts" placeholder="Tanggal Lahir Ts" value="<?php echo $tanggal_lahir_ts; ?>" />
	    	</td>
	    </tr>
	    <tr><td width='200'>Alamat Ts <?php echo form_error('alamat_ts') ?></td>
	    	<td><input type="text" class="form-control" name="alamat_ts" id="alamat_ts" placeholder="Alamat Ts" value="<?php echo $alamat_ts; ?>" />
	    	</td>
	    </tr>
	    <tr><td width='200'>Pendidikan Ts <?php echo form_error('pendidikan_ts') ?></td>
	    	<td><input type="text" class="form-control" name="pendidikan_ts" id="pendidikan_ts" placeholder="Pendidikan Ts" value="<?php echo $pendidikan_ts; ?>" />
	    	</td>
	    </tr>
	    <tr><td width='200'>No Hp Ts <?php echo form_error('no_hp_ts') ?></td>
	    	<td><input type="text" class="form-control" name="no_hp_ts" id="no_hp_ts" placeholder="No Hp Ts" value="<?php echo $no_hp_ts; ?>" />
	    	</td>
	    </tr>
	    <tr><td width='200'>Gol Darah Ts <?php echo form_error('gol_darah_ts') ?></td>
	    	<td><input type="text" class="form-control" name="gol_darah_ts" id="gol_darah_ts" placeholder="Gol Darah Ts" value="<?php echo $gol_darah_ts; ?>" />
	    	</td>
	    </tr>
	    <tr><td width='200'>Id Penjadwalan <?php echo form_error('id_penjadwalan') ?></td>
	    	<td><?php echo cmb_dinamis('id_penjadwalan', 'tbl_jadwal', 'keterangan', 'id_penjadwalan') ?></td>
	    </tr>
	    <tr><td width='200'>Id Kunjungan <?php echo form_error('id_kunjungan') ?></td>
	    	<td><?php echo cmb_dinamis('id_kunjungan', 'tbl_kunjungan', 'keterangan', 'id_kunjungan') ?></td>
	    </tr>
	    <tr><td width='200'>Id User Level <?php echo form_error('id_user_level') ?></td>
	    	<td><input type="text" class="form-control" name="id_user_level" id="id_user_level" placeholder="Id User Level" value="<?php echo $id_user_level; ?>" />
	    	</td>
	    </tr>
	    <tr><td></td>
	    	<td><input type="hidden" name="id_ts" value="<?php echo $id_ts; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('ts') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>