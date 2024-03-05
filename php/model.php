<?php
function add_rajaongkirstarter($table_name, $data = array())
{
    global $wpdb;
    $table = $wpdb->prefix . $table_name;
    $wpdb->insert($table, $data);
    $id_insert = $wpdb->insert_id;
    return $id_insert;
}

function get_rajaongkirstarter($table_name, $name)
{
    global $wpdb;
    $table = $wpdb->prefix . $table_name;
    $query = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE option_name=%s", $name));
    return $query;
}

function update_rajaongkirstarter($table_name, $data = array(), $where = array())
{
    global $wpdb;
    $table = $wpdb->prefix . $table_name;
    $update = $wpdb->update($table, $data, $where);
    return $update;
}

function delete_rajaongkirstarter($table_name, $where = array())
{
    global $wpdb;
    $table = $wpdb->prefix . $table_name;
    $delete = $wpdb->delete($table, $where);
    return $delete;
}
