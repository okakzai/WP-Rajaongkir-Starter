<div class="container-fluid px-0">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-12 mb-1">
                            <input id="asal" class="form-control" placeholder="Ketik Asal Pengiriman">
                            <input id="asalkota" class="form-control" type="hidden">
                        </div>
                        <div class="col-md-3 col-12 mb-1">
                            <input id="tujuan" class="form-control" placeholder="Ketik Tujuan Pengiriman">
                            <input id="tujuankota" class="form-control" type="hidden">
                        </div>
                        <div class="col-md-3 col-12 mb-1">
                            <input id="berat" type="number" min="1" class="form-control" placeholder="Ketik Berat (Gram)">
                        </div>
                        <div class="col-md-3 col-12 mb-1 py-1">
                            <div class="d-flex align-items-center justify-content-end">
                                <?php 
$n = count( $kurir );
for ( $i = 0 ;  $i < $n ;  $i++ ) {
    $j = $i + 1;
    ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kurir" id="kurir<?php 
    echo  $j ;
    ?>" value="<?php 
    echo  $kurir[$i] ;
    ?>" <?php 
    if ( $i == 0 ) {
        echo  'checked' ;
    }
    ?>>
                                        <label class="form-check-label text-muted small text-uppercase" for="kurir<?php 
    echo  $j ;
    ?>"><?php 
    echo  $kurir[$i] ;
    ?></label>
                                    </div>
                                <?php 
}
?>
                            </div>
                        </div>
                    </div>
                    <?php 
?>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="mr-1">
                                    Developed by
                                </div>
                                <div>
                                    <a href="https://fastwork.id/user/majuappz/web-development-97336575" target="_blank">
                                        <img width="50" class="img-fluid" src="<?php 
echo  plugin_dir_url( __FILE__ ) . '../../assets/logo.png' ;
?>">
                                    </a>
                                </div>
                            </div>
                            <button id="cek_raj" type="submit" class="btn btn-danger text-white">
                                Cek Ongkir <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    <?php 
?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body">
                    <div id="loading_raj" class="d-none"><img src="<?php 
echo  plugin_dir_url( __FILE__ ) . '../../assets/ajax-loader.gif' ;
?>"></div>
                    <div id="ket_raj" class="mb-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>