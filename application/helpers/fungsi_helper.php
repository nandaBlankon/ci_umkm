<?php

function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('user_id');
    if ($user_session) {
        redirect('dashboard');
    }
}

function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('user_id');
    if (!$user_session) {
        redirect('');
    }
}

function check_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 1) {
        redirect('dashboard');
    }
}

function inputtext($name, $table, $field, $primary_key, $selected)
{
    $ci = get_instance();
    $data = $ci->db->get($table)->result();
    foreach ($data as $t) {
        if ($selected == $t->$primary_key) {
            $txt = $t->$field;
        }
    }
    return $txt;

    #cara pakai = echo inputtext('id_jenis','tb_jenis','nama_jenis','id_jenis',$penjualan->id_jenis);
}
