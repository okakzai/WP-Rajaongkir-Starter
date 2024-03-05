<?php

/**
 * Plugin Name: Rajaongkir Starter
 * Description: Cek ongkir kurir JNE, POS dan TIKI antar kota menggunakan API Rajaongkir Starter.
 * Author: MajuAppZ
 * Author URI: https://majuappz.blogspot.com/
 * Version: 1.0
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'raj_fs' ) ) {
    raj_fs()->set_basename( false, __FILE__ );
} else {
    // DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
    
    if ( !function_exists( 'raj_fs' ) ) {
        // Create a helper function for easy SDK access.
        function raj_fs()
        {
            global  $raj_fs ;
            
            if ( !isset( $raj_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $raj_fs = fs_dynamic_init( array(
                    'id'             => '15077',
                    'slug'           => 'rajaongkirstarter',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_2716638de508ff6d2dd8904854c13',
                    'is_premium'     => false,
                    'premium_suffix' => 'Premium',
                    'has_addons'     => false,
                    'has_paid_plans' => true,
                    'menu'           => array(
                    'support' => false,
                ),
                    'is_live'        => true,
                ) );
            }
            
            return $raj_fs;
        }
        
        // Init Freemius.
        raj_fs();
        // Signal that SDK was initiated.
        do_action( 'raj_fs_loaded' );
    }
    
    // Act on plugin activation
    register_activation_hook( __FILE__, "activate_rajaongkirstarter" );
    function activate_rajaongkirstarter()
    {
        // Insert Option for rajaongkirstarter_apikey
        init_rajaongkirstarter_apikey();
        // Insert Option for rajaongkirstarter_kurir
        init_rajaongkirstarter_kurir();
    }
    
    // Initialize Option for rajaongkirstarter_apikey
    function init_rajaongkirstarter_apikey()
    {
        global  $wpdb ;
        $table_name = 'options';
        $table = $wpdb->prefix . $table_name;
        $name = 'rajaongkirstarter_apikey';
        // Insert rajaongkirstarter_apikey if not exist
        $hasil = $wpdb->get_results( $wpdb->prepare( "SELECT COUNT(option_name) AS jumlah FROM {$table} WHERE option_name=%s", $name ) );
        
        if ( $hasil[0]->jumlah == 0 ) {
            $data = array(
                'option_name' => 'rajaongkirstarter_apikey',
            );
            $wpdb->insert( $table, $data );
            $id_insert = $wpdb->insert_id;
        }
    
    }
    
    // Initialize Option for rajaongkirstarter_kurir
    function init_rajaongkirstarter_kurir()
    {
        global  $wpdb ;
        $table_name = 'options';
        $table = $wpdb->prefix . $table_name;
        $name = 'rajaongkirstarter_kurir';
        // Insert rajaongkirstarter_kurir if not exist
        $hasil = $wpdb->get_results( $wpdb->prepare( "SELECT COUNT(option_name) AS jumlah FROM {$table} WHERE option_name=%s", $name ) );
        
        if ( $hasil[0]->jumlah == 0 ) {
            $data = array(
                'option_name' => 'rajaongkirstarter_kurir',
            );
            $wpdb->insert( $table, $data );
            $id_insert = $wpdb->insert_id;
        }
    
    }
    
    // Act on plugin de-activation
    register_deactivation_hook( __FILE__, "deactivate_rajaongkirstarter" );
    function deactivate_rajaongkirstarter()
    {
        // Delete Option for rajaongkirstarter_apikey
        delete_rajaongkirstarter_apikey();
        // Delete Option for rajaongkirstarter_kurir
        delete_rajaongkirstarter_kurir();
    }
    
    // Delete Option for rajaongkirstarter_apikey
    function delete_rajaongkirstarter_apikey()
    {
        global  $wpdb ;
        $table_name = 'options';
        $where = array(
            'option_name' => 'rajaongkirstarter_apikey',
        );
        $table = $wpdb->prefix . $table_name;
        $wpdb->delete( $table, $where );
    }
    
    // Delete Option for rajaongkirstarter_kurir
    function delete_rajaongkirstarter_kurir()
    {
        global  $wpdb ;
        $table_name = 'options';
        $where = array(
            'option_name' => 'rajaongkirstarter_kurir',
        );
        $table = $wpdb->prefix . $table_name;
        $wpdb->delete( $table, $where );
    }
    
    define( 'ADMIN_RAJAONGKIRSTARTER', plugin_dir_path( __FILE__ ) . '/views/admin/' );
    define( 'LANDING_RAJAONGKIRSTARTER', plugin_dir_path( __FILE__ ) . '/views/landing/' );
    define( 'KOTA_JSON', plugin_dir_path( __FILE__ ) . '/kota.json' );
    include 'php/helper.php';
    include 'php/model.php';
    include 'php/admin.php';
    include 'php/landing.php';
    // Mulai-Menyambungkan CSS dan JS ke WP Plugin
    // Hooknya Backend admin_enqueue_scripts
    // Hooknya Frontend wp_enqueue_scripts
    add_action( 'admin_enqueue_scripts', 'admin_rajaongkirstarter' );
    function admin_rajaongkirstarter()
    {
        wp_enqueue_style( 'bs', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' );
        wp_enqueue_style( 'dt', 'https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css' );
        wp_enqueue_style( 'dt_button', 'https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css' );
        wp_enqueue_script( 'bs', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js' );
        wp_enqueue_script( 'fa', 'https://kit.fontawesome.com/c00efe6860.js' );
        wp_enqueue_script( 'dt', 'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js' );
        wp_enqueue_script( 'dt_button', 'https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js' );
        wp_enqueue_script( 'dt_zip', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js' );
        wp_enqueue_script( 'dt_pdf', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js' );
        wp_enqueue_script( 'dt_pdf_font', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js' );
        wp_enqueue_script( 'dt_button_html', 'https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js' );
    }
    
    add_action( 'wp_enqueue_scripts', 'landing_rajaongkirstarter' );
    function landing_rajaongkirstarter()
    {
        wp_enqueue_style( 'bs', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' );
        wp_enqueue_style( 'dt', 'https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css' );
        wp_enqueue_style( 'dt_button', 'https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css' );
        wp_enqueue_style( 'dt_bs_responsive', 'https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css' );
        wp_enqueue_style( 'autocomplete', plugins_url(
            '/autocomplete/jquery-ui-min.css',
            __FILE__,
            array(),
            wp_rand(),
            true
        ) );
        wp_enqueue_style( 'custom_rajaongkirstarter', plugins_url(
            '/css/custom.css',
            __FILE__,
            array(),
            wp_rand(),
            true
        ) );
        wp_deregister_script( 'jquery' );
        wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.7.0.js' );
        wp_enqueue_script( 'bs', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js' );
        wp_enqueue_script( 'fa', 'https://kit.fontawesome.com/c00efe6860.js' );
        wp_enqueue_script( 'dt', 'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js' );
        wp_enqueue_script( 'dt_button', 'https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js' );
        wp_enqueue_script( 'dt_zip', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js' );
        wp_enqueue_script( 'dt_pdf', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js' );
        wp_enqueue_script( 'dt_pdf_font', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js' );
        wp_enqueue_script( 'dt_button_html', 'https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js' );
        wp_enqueue_script( 'dt_responsive', 'https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js' );
        wp_enqueue_script( 'dt_bs_responsive', 'https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js' );
        wp_enqueue_script( 'swal', 'https://cdn.jsdelivr.net/npm/sweetalert2@11' );
        wp_enqueue_script( 'autocomplete', plugins_url(
            '/autocomplete/jquery-ui.min.js',
            __FILE__,
            array(),
            wp_rand(),
            true
        ) );
        wp_enqueue_script( 'autocomplete_scroll', plugins_url(
            '/autocomplete/jquery.ui.autocomplete.scroll.min.js',
            __FILE__,
            array(),
            wp_rand(),
            true
        ) );
        wp_enqueue_script( 'custom_rajaongkirstarter', plugins_url(
            '/js/custom.js',
            __FILE__,
            array(),
            wp_rand(),
            true
        ) );
        wp_localize_script( 'custom_rajaongkirstarter', 'RajaongkirAjax', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ) );
    }
    
    // Selesai-Menyambungkan CSS dan JS ke WP Plugin
    add_action( 'wp_ajax_cek_ongkir', 'cek_ongkir' );
    add_action( 'wp_ajax_nopriv_cek_ongkir', 'cek_ongkir' );
    function cek_ongkir()
    {
        $get_apikey = get_rajaongkirstarter( 'options', 'rajaongkirstarter_apikey' );
        
        if ( isset( $get_apikey ) ) {
            $api_key = $get_apikey[0]->option_value;
        } else {
            $api_key = '';
        }
        
        $asal = $_POST['asal'];
        $tujuan = $_POST['tujuan'];
        $berat = $_POST['berat'];
        $kurir = $_POST['kurir'];
        $curl = curl_init();
        curl_setopt_array( $curl, array(
            CURLOPT_URL            => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => "origin=" . $asal . "&destination=" . $tujuan . "&weight=" . $berat . "&courier=" . $kurir,
            CURLOPT_HTTPHEADER     => array( "content-type: application/x-www-form-urlencoded", "key:{$api_key}" ),
        ) );
        $response = curl_exec( $curl );
        $err = curl_error( $curl );
        curl_close( $curl );
        
        if ( $err ) {
            echo  "error^" . $err ;
        } else {
            echo  $response ;
        }
        
        wp_die();
    }
    
    add_action( 'wp_ajax_cek_kota', 'cek_kota' );
    add_action( 'wp_ajax_nopriv_cek_kota', 'cek_kota' );
    function cek_kota()
    {
        $term = $_POST["term"];
        $asal = json_decode( file_get_contents( KOTA_JSON ), true );
        $result = array();
        foreach ( $asal as $company ) {
            $companyLabel = $company["label"];
            if ( strpos( strtoupper( $companyLabel ), strtoupper( $term ) ) !== false ) {
                array_push( $result, $company );
            }
        }
        echo  json_encode( $result ) ;
        wp_die();
    }

}
