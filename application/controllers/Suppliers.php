<?php

class Suppliers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Suppliers_model', 'suppliers_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Suppliers :: Kouvee';
<<<<<<< HEAD
        // $data['suppliers'] = $this->suppliers_model->getsuppliers();
        $data['suppliers'] = $this->suppliers_model->get_by_employee();

=======
        // $data['suppliers'] = $this->suppliers_model->getSuppliers();
        $data['suppliers'] = $this->suppliers_model->get_by_employee();

        //buat search
        if ($this->input->post('keyword')) {
            $data['suppliers'] = $this->suppliers_model->searchSuppliers();
        }

>>>>>>> 1338867e81a846c093c06997201f0f9fa35ad5bb
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/suppliers', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_suppliers()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Supplier';

        $this->form_validation->set_rules('supplier_name', 'Name', 'required');
<<<<<<< HEAD
        $this->form_validation->set_rules('supplier_phoneno', 'Phone Number', 'required|numeric');
        $this->form_validation->set_rules('supplier_address', 'Address', 'required');
=======
        $this->form_validation->set_rules('supplier_address', 'Address', 'required');
        $this->form_validation->set_rules('supplier_phoneno', 'Phone Number', 'required|numeric');
>>>>>>> 1338867e81a846c093c06997201f0f9fa35ad5bb

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/add_supplier');
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'supplier_name' => $this->input->post('supplier_name'),
                'supplier_address' => $this->input->post('supplier_address'),
                'supplier_phoneno' => $this->input->post('supplier_phoneno')
            ];
            $this->suppliers_model->createSuppliers($data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Supplier added !
          </div>');
            redirect('suppliers');
        }
    }

    public function delete_suppliers($id)
    {
        $this->suppliers_model->deleteSuppliers($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Supplier deleted !
          </div>');
        redirect('suppliers');
    }

    public function edit_suppliers($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Edit Supplier';
        $data['supplier'] = $this->suppliers_model->getSuppliers($id);

        $this->form_validation->set_rules('supplier_name', 'Name', 'required');
        $this->form_validation->set_rules('supplier_address', 'Address', 'required');
        $this->form_validation->set_rules('supplier_phoneno', 'Phone Number', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/edit_supplier', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'supplier_name' => $this->input->post('supplier_name'),
                'supplier_address' => $this->input->post('supplier_address'),
                'supplier_phoneno' => $this->input->post('supplier_phoneno')
            ];

            $this->suppliers_model->updateSuppliers($data, $id);
            redirect('suppliers');
        }
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 1338867e81a846c093c06997201f0f9fa35ad5bb
