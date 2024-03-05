<?php
// Initialize Option for rajaongkirstarter_apikey
function create_rajaongkirstarter_apikey()
{
    global  $wpdb;
    $table_name = 'options';
    $table = $wpdb->prefix . $table_name;
    $name = 'rajaongkirstarter_apikey';
    // Insert rajaongkirstarter_apikey if not exist
    $hasil = $wpdb->get_results($wpdb->prepare("SELECT COUNT(option_name) AS jumlah FROM $table WHERE option_name=%s", $name));
    if ($hasil[0]->jumlah == 0) {
        $data = array(
            'option_name' => 'rajaongkirstarter_apikey'
        );
        $wpdb->insert($table, $data);
        $id_insert = $wpdb->insert_id;
    }
}

// Initialize Option for rajaongkirstarter_kurir
function create_rajaongkirstarter_kurir()
{
    global  $wpdb;
    $table_name = 'options';
    $table = $wpdb->prefix . $table_name;
    $name = 'rajaongkirstarter_kurir';
    // Insert rajaongkirstarter_kurir if not exist
    $hasil = $wpdb->get_results($wpdb->prepare("SELECT COUNT(option_name) AS jumlah FROM $table WHERE option_name=%s", $name));
    if ($hasil[0]->jumlah == 0) {
        $data = array(
            'option_name' => 'rajaongkirstarter_kurir'
        );
        $wpdb->insert($table, $data);
        $id_insert = $wpdb->insert_id;
    }
}

// Show Radiobuttons for kurir option
function get_kurir()
{
    $get_kurir = get_rajaongkirstarter('options', 'rajaongkirstarter_kurir');
    if (isset($get_kurir)) {
        $data = $get_kurir[0]->option_value;
        if (!empty($data)) {
            return $kurir = explode(',', $data);
        } else {
            return $kurir = array('jne');
        }
    } else {
        return $kurir = array('jne');
    }
}
