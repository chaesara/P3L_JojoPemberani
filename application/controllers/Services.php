<?php

class Services extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Services_model', 'services_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Services :: Kouvee';
        // $data['customers'] = $this->customers_model->getCustomers();
        $data['services'] = $this->services_model->get_by_employee();

        //buat search
        if ($this->input->post('keyword')) {
            $data['services'] = $this->services_model->searchServices();
        }

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/services', $data);
        $this->load->view('templates/admin_footer');
    }
}
