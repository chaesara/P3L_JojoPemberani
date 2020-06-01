<?php


class Reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Reports :: Kouvee';

        $this->load->view('templates/admin_header');
        $this->load->view('admin/reports/reports');
        $this->load->view('templates/admin_footer');
    }

    public function outcome()
    {
        $data['title'] = 'Outcome Report :: Kouvee';

        $this->load->view('templates/admin_header');
        $this->load->view('admin/reports/outcome');
        $this->load->view('templates/admin_footer');
    }
}
