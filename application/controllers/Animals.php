<?php


class Animals extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Animals';

        $this->load->view('templates/admin_header');
        $this->load->view('admin/animals');
        $this->load->view('templates/admin_footer');
    }
}
