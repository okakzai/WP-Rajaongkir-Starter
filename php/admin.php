<?php

/**
 * Function menampilkan menu
 * Hook: admin_menu
 */
add_action( 'admin_menu', 'menu_rajaongkirstarter' );
function menu_rajaongkirstarter()
{
    add_menu_page(
        'Rajaongkir Starter',
        //Page Title
        'Rajaongkir Starter',
        //Menu Title
        'manage_options',
        //Capability
        'rajaongkirstarter',
        //Slug URL
        'dashboard_rajaongkirstarter',
        //Callback
        'dashicons-search'
    );
    add_submenu_page(
        'rajaongkirstarter',
        //Parent Slug
        'Dashboard - Rajaongkir Starter',
        //Page Title
        'Dashboard',
        //Menu Title
        'manage_options',
        //Capability
        'rajaongkirstarter',
        //Slug URL
        'dashboard_rajaongkirstarter'
    );
    add_submenu_page(
        'rajaongkirstarter',
        //Parent Slug
        'API Key - Rajaongkir Starter',
        //Page Title
        'API Key',
        //Menu Title
        'manage_options',
        //Capability
        'rajaongkirstarter-apikey',
        //Slug URL
        'apikey_rajaongkirstarter'
    );
    add_submenu_page(
        'rajaongkirstarter',
        //Parent Slug
        'Kurir - Rajaongkir Starter',
        //Page Title
        'Kurir',
        //Menu Title
        'manage_options',
        //Capability
        'rajaongkirstarter-kurir',
        //Slug URL
        'kurir_rajaongkirstarter'
    );
}

function dashboard_rajaongkirstarter()
{
    include ADMIN_RAJAONGKIRSTARTER . 'dashboard.php';
}

function apikey_rajaongkirstarter()
{
    // Insert Option for rajaongkirstarter_apikey
    create_rajaongkirstarter_apikey();
    
    if ( isset( $_REQUEST['_apikey_nonce'] ) ) {
        
        if ( wp_verify_nonce( $_REQUEST['_apikey_nonce'], 'apikey_data' ) ) {
            $apikey = ( isset( $_POST['apikey'] ) ? $_POST['apikey'] : '' );
            
            if ( !empty($apikey) ) {
                $data = array(
                    'option_value' => $apikey,
                );
                $where = array(
                    'option_name' => 'rajaongkirstarter_apikey',
                );
                $update_rajaongkirstarter = update_rajaongkirstarter( 'options', $data, $where );
                
                if ( $update_rajaongkirstarter ) {
                    $notifikasi = '<div class="bg bg-success text-white small p-1 mb-3 rounded text-center">Data berhasil diubah!</div>';
                } else {
                    $notifikasi = '<div class="bg bg-danger text-white small p-1 mb-3 rounded text-center">Data gagal diubah!</div>';
                }
                
                include ADMIN_RAJAONGKIRSTARTER . 'apikey.php';
            } else {
                $notifikasi = '<div class="bg bg-warning text-white small p-1 mb-3 rounded text-center">Data harus diisi!</div>';
                include ADMIN_RAJAONGKIRSTARTER . 'apikey.php';
            }
        
        } else {
            $notifikasi = '<div class="bg bg-danger text-white small p-1 mb-3 rounded text-center">Data tidak valid!</div>';
            include ADMIN_RAJAONGKIRSTARTER . 'apikey.php';
        }
    
    } else {
        include ADMIN_RAJAONGKIRSTARTER . 'apikey.php';
    }

}

function kurir_rajaongkirstarter()
{
    include ADMIN_RAJAONGKIRSTARTER . 'upgrade.php';
}
