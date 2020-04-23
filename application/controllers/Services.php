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
        $data['sizes'] = $this->services_model->getSizes();

        //buat search
        if ($this->input->post('keyword')) {
            $data['services'] = $this->services_model->searchServices();
        }

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/services', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_services()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Service';
        $data['sizes'] = $this->services_model->getSizes();

        $this->form_validation->set_rules('service_name', 'Name', 'required|is_unique[services.service_name]');
        $this->form_validation->set_rules('service_price', 'Price', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/add_service', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'size_id' => $this->services_model->getSizeId($this->input->post('size_name')),
                'service_name' => $this->input->post('service_name'),
                'service_price' => $this->input->post('service_price'),
            ];
            $this->services_model->createServices($data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Service added !
          </div>');
            redirect('services');
        }
    }

    public function delete_services($id)
    {
        $this->services_model->deleteServices($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Service deleted !
          </div>');
        redirect('services');
    }

    public function edit_services($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['service'] = $this->services_model->getServices($id);
        $data['title'] = 'Edit Service : ' . $data['service']['service_name'];

        $this->form_validation->set_rules('service_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/edit_service', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'service_name' => $this->input->post('service_name'),
                'service_price' => $this->input->post('service_price'),
            ];

            $this->services_model->updateServices($data, $id);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Service updated !
          </div>');
            redirect('services');
        }
    }
}
