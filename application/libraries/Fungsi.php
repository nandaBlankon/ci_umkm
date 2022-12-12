<?php

class Fungsi
{

    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('model_user');
        $user_id = $this->ci->session->userdata('user_id');
        $user_data = $this->ci->model_user->get($user_id)->row();
        return $user_data;
    }

    public function nominal($angka)
    {
        return "Rp. " . number_format($angka, 0, ',', '.') . ",-";
    }

    public function slug($temp)
    {
        $string = preg_replace("/[^a-zA-Z0-9 &%|{.}=,?!*()-_+$@;<>']/", '', $temp);
        $trim = trim($string);
        $slug = strtolower(str_replace(" ", "-", $trim));
        $slug = strtolower(str_replace("_", "-", $slug));
        return $slug;
    }
}
