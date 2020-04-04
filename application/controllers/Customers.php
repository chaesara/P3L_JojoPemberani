<?php

class Customers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customers_model', 'customers_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Customers List :: Kouvee';
        // $data['customers'] = $this->customers_model->getCustomers();
        $data['customers'] = $this->customers_model->get_by_employee();

        //buat search
        if ($this->input->post('keyword')) {
            $data['customers'] = $this->customers_model->searchCustomers();
        }

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/customers', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_customers()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Customer';

        $this->form_validation->set_rules('customer_name', 'Name', 'required');
        $this->form_validation->set_rules('customer_phoneno', 'Phone Number', 'required|numeric');
        $this->form_validation->set_rules('customer_address', 'Address', 'required');
        $this->form_validation->set_rules('customer_membership', 'Membership', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/add_customer');
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'customer_name' => $this->input->post('customer_name'),
                'customer_address' => $this->input->post('customer_address'),
                'customer_phoneno' => $this->input->post('customer_phoneno'),
                'customer_birth' => $this->input->post('customer_birth'),
                'customer_membership' => $this->input->post('customer_membership'),
            ];
            $this->customers_model->createCustomers($data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Customer added !
          </div>');
            redirect('customers');
        }
    }

    public function delete_customers($id)
    {
        $this->customers_model->deleteCustomers($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Customer deleted !
          </div>');
        redirect('customers');
    }

    public function edit_employees($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Edit Customer';
        $data['customer'] = $this->customers_model->getCustomers($id);

        $this->form_validation->set_rules('customer_name', 'Name', 'required');
        $this->form_validation->set_rules('customer_phoneno', 'Phone Number', 'required|numeric');
        $this->form_validation->set_rules('customer_address', 'Address', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/edit_customer', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'customer_name' => $this->input->post('customer_name'),
                'customer_address' => $this->input->post('customer_address'),
                'customer_phoneno' => $this->input->post('customer_phoneno'),
                'customer_birth' => $this->input->post('customer_birth')
            ];

            $this->customers_model->updateCustomers($data, $id);
            redirect('customers');
        }
    }
}
