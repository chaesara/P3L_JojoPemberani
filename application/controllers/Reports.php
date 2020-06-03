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
        $data['month'] = $this->reports_model->getSupplyMonth();
        $data['year'] = $this->reports_model->getSupplyYear();

        $this->form_validation->set_rules('year', 'Year', 'required');
        $this->form_validation->set_rules('month', 'Month', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/reports/reports', $data);
            $this->load->view('templates/admin_footer');
        } else {
            //$this->reports_model->outcomeReport($this->input->post('year'), $this->input->post('month'));
            $this->outcome($this->input->post('year'), $this->input->post('month'));
        }
    }

    public function outcome($year = null, $month = null)
    {
        $data['title'] = 'Outcome Report :: Kouvee';
        $data['outcome'] = $this->reports_model->outcomeReport();
        $data['month'] = $this->reports_model->getSupplyMonth();

        $this->load->view('admin/reports/outcome', $data);
    }
}
