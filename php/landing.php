<?php

/**
 * Function menampilkan shortcode
 * Hook: add_shortcode
 */
add_shortcode( 'rajaongkirstarter', 'tampil_rajaongkirstarter' );
function tampil_rajaongkirstarter()
{
    ob_start();
    // Insert Option for rajaongkirstarter_kurir
    create_rajaongkirstarter_kurir();
    $kurir = array( 'jne' );
    include LANDING_RAJAONGKIRSTARTER . 'tampil.php';
    $output = ob_get_clean();
    return $output;
}
