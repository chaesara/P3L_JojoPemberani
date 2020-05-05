<?php

class Animal_types extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Animal_types_model', 'animal_types_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Animal_types :: Kouvee';
        // $data['animal_types'] = $this->animal_types_model->getAnimal_types();
        $data['animal_types'] = $this->animal_types_model->get_by_employee();

        //buat search
        if ($this->input->post('keyword')) {
            $data['animal_types'] = $this->animal_types_model->searchAnimal_types();
        }

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/animal_types', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_animal_types()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Animal_type';

        $this->form_validation->set_rules('animal_type_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/add_animal_type');
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'animal_type_name' => $this->input->post('animal_type_name'),
            ];
            $this->animal_types_model->createAnimal_types($data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Animal types added !
          </div>');
            redirect('animal_types');
        }
    }

    public function delete_animal_types($id)
    {
        $this->animal_types_model->deleteAnimal_types($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Animal types deleted !
          </div>');
        redirect('animal_types');
    }

    public function edit_animal_types($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Edit Animal_type';
        $data['animal_type'] = $this->animal_types_model->getAnimal_types($id);

        $this->form_validation->set_rules('animal_type_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/edit_animal_type', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'animal_type_name' => $this->input->post('animal_type_name')
            ];

            $this->animal_types_model->updateAnimal_types($data, $id);
            redirect('animal_types');
        }
    }
}
