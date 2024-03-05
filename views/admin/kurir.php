<div class="container py-5">
    <div class="align-items-center text-center">
        <h2>Pengaturan Kurir</h2>
        <p>
            Pilih kurir yang ingin ditampilkan di shortcode <span class="font-weight-bolder text-primary">[rajaongkirstarter]</span>.
        </p>
    </div>
    <?php 
?>
        <div class="mt-3 d-flex align-items-center justify-content-center">
            <div>
                <a href="http://projects.id/ukfaxt">
                    <img class="img-fluid p-1" src="<?php 
echo  plugin_dir_url( __FILE__ ) . '../../banner/3.png' ;
?>">
                </a>
            </div>
        </div>
    <?php 
?>
    <div class="d-flex align-items-center justify-content-center">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <?php 
if ( isset( $notifikasi ) ) {
    echo  $notifikasi ;
}
?>
                </div>
                <form action="" method="POST">
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Kurir</label>
                        <div class="col-8 d-flex align-items-center justify-content-end pr-0">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="kurir[]" type="checkbox" value="jne" <?php 
if ( in_array( "jne", $kurir ) ) {
    echo  'checked' ;
}
?>>
                                <label class="form-check-label">JNE</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="kurir[]" type="checkbox" value="pos" <?php 
if ( in_array( "pos", $kurir ) ) {
    echo  'checked' ;
}
?>>
                                <label class="form-check-label">POS</label>
                            </div>
                            <div class="form-check form-check-inline mr-0">
                                <input class="form-check-input" name="kurir[]" type="checkbox" value="tiki" <?php 
if ( in_array( "tiki", $kurir ) ) {
    echo  'checked' ;
}
?>>
                                <label class="form-check-label">TIKI</label>
                            </div>
                        </div>
                    </div>
                    <?php 
echo  wp_nonce_field( 'kurir_data', '_kurir_nonce' ) ;
?>
                    <div class="form-group row float-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>