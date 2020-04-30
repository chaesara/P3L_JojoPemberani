<?php

class AnimalTypes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AnimalTypes_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Animal Types :: Kouvee';
        // $data['customers'] = $this->customers_model->getCustomers();
        $data['types'] = $this->AnimalTypes_model->get_by_employee();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/animalTypes', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_animalTypes()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add AnimalType';

        $this->form_validation->set_rules('type_name', 'Name', 'required|is_unique[animal_types.type_name]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/add_animalType', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'type_name' => $this->input->post('type_name')
            ];
            $this->AnimalTypes_model->createAnimalTypes($data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Animal Type added !
          </div>');
            redirect('animalTypes');
        }
    }

    public function delete_animalTypes($id)
    {
        $this->AnimalTypes_model->deleteAnimalTypes($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            AnimalType deleted !
          </div>');
        redirect('animalTypes');
    }

    public function edit_animalTypes($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['types'] = $this->AnimalTypes_model->getAnimalTypes($id);
        $data['title'] = 'Edit AnimalType : ' . $data['AnimalType']['AnimalType_name'];

        $this->form_validation->set_rules('AnimalType_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/edit_animalType', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'AnimalType_name' => $this->input->post('AnimalType_name')
            ];

            $this->AnimalTypes_model->updateAnimalTypes($data, $id);
            redirect('animalTypes');
        }
    }
}
