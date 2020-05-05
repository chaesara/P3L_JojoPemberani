<?php

class Sizes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sizes_model', 'sizes_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Sizes :: Kouvee';
        // $data['customers'] = $this->customers_model->getCustomers();
        $data['sizes'] = $this->sizes_model->get_by_employee();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/sizes', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_sizes()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Size';

        $this->form_validation->set_rules('size_name', 'Name', 'required|is_unique[Sizes.size_name]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/add_size', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'size_name' => $this->input->post('size_name')
            ];
            $this->sizes_model->createSizes($data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Size added !
          </div>');
            redirect('sizes');
        }
    }

    public function delete_Sizes($id)
    {
        $this->sizes_model->deleteSizes($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Size deleted !
          </div>');
        redirect('sizes');
    }

    public function edit_Sizes($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['size'] = $this->sizes_model->getSizes($id);
        $data['title'] = 'Edit size : ' . $data['size']['size_name'];

        $this->form_validation->set_rules('size_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/edit_size', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'size_name' => $this->input->post('size_name')
            ];

            $this->sizes_model->updateSizes($data, $id);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Size updated !
          </div>');
            redirect('sizes');
        }
    }
}
