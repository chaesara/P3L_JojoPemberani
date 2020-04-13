<?php

class Logger extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Activity Log';

        $this->load->view('templates/admin_header');
        $this->load->view('admin/logger.php');
        $this->load->view('templates/admin_footer');
    }
    
}
