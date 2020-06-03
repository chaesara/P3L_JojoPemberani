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
        $data['year_tr'] = $this->reports_model->getTransactionYear();

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

    public function topProducts()
    {
        $data['title'] = 'Top Products Report :: Kouvee';
        $data['outcome'] = $this->reports_model->outcomeReport();
        $data['month'] = $this->reports_model->getSupplyMonth();

        $this->load->view('admin/reports/top_products', $data);
    }

    public function monthly_income($year, $month)
    {
        $data['title'] = 'Services Report :: Kouvee';
        $data['services'] = $this->reports_model->getMonthlyServices($year, $month);
        $data['products'] = $this->reports_model->getMonthlyProducts($year, $month);
        $data['date'] = ['year' => $year, 'month' => $month];

        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('d-M-Y');
        $data['print_date'] = $now;

        $this->load->library('pdfgenerator');

        $html = $this->load->view('admin/reports/monthly_income', $data, true);

        $this->pdfgenerator->generate($html, 'Monthly Income : ' . $month . $year);

        // $this->load->view('admin/reports/outcome', $data);
    }
}
