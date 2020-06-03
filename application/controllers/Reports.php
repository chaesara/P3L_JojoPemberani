<?php


class Reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reports_model', 'reports_model');
    }

    public function index()
    {
        $data['title'] = 'Reports :: Kouvee';
        $data['supplies'] = $this->reports_model->getSupplyYear();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/reports/reports', $data);
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
