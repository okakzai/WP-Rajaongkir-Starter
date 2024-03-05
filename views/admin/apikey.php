<div class="container py-5">
    <div class="align-items-center text-center">
        <h2>Pengaturan API Key</h2>
        <p>
            Masukkan API Key Rajaongkir tipe akun Starter.
        </p>
        Belum punya API Key? <a href="https://rajaongkir.com/akun/daftar" target="_blank">Buat Akun!</a></h3>
    </div>
    <?php 
?>
        <div class="mt-3 d-flex align-items-center justify-content-center">
            <div>
                <a href="http://projects.id/ukfaxt">
                    <img class="img-fluid p-1" src="<?php 
echo  plugin_dir_url( __FILE__ ) . '../../banner/2.png' ;
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
                        <label class="col-4 col-form-label">API Key</label>
                        <?php 
$get_apikey = get_rajaongkirstarter( 'options', 'rajaongkirstarter_apikey' );

if ( isset( $get_apikey ) ) {
    ?>
                            <input class="col-8 form-control" type="text" name="apikey" placeholder="Masukkan API Key Rajaongkir Starter" value="<?php 
    echo  $get_apikey[0]->option_value ;
    ?>">
                        <?php 
} else {
    ?>
                            <input class="col-8 form-control" type="text" name="apikey" placeholder="Masukkan API Key Rajaongkir Starter">
                        <?php 
}

?>
                    </div>
                    <?php 
echo  wp_nonce_field( 'apikey_data', '_apikey_nonce' ) ;
?>
                    <div class="form-group row float-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>