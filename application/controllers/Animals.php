<?php


class Animals extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Animals_model','animals_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Animals :: Kouvee';
        $data['animals'] = $this->animals_model->get_by_employee();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/animals', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_animals()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Ansimal';
        $data['customers'] = $this->animals_model->getCustomers();
        $data['types'] = $this->animals_model->getTypes();

        $this->form_validation->set_rules('animal_name', 'Name', 'required|is_unique[animals.animal_name]');
        $this->form_validation->set_rules('animal_birth', 'Birth Date', 'required');
        $this->form_validation->set_rules('customer_id', 'Customer ID', 'required');
        $this->form_validation->set_rules('type_id', 'Type ID', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/add_animal', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'animal_name' => $this->input->post('animal_name'),
                'customer_id' => $this->animals_model->getCustomerId($this->input->post('customer_name')),
                'type_id' => $this->animals_model->getTypeId($this->input->post('type_name')),
                'animal_birth' => $this->input->post('animal_birth'),
            ];
            $this->animals_model->createAnimals($data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            animal added !
          </div>');
            redirect('animals');
        }
    }

    public function delete_animals($id)
    {
        $this->animals_model->deleteAnimals($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Animal deleted !
          </div>');
        redirect('animals');
    }

    public function edit_animals($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['animal'] = $this->animals_model->getAnimals($id);
        $data['title'] = 'Edit Animal : ' . $data['animal']['animal_name'];

        $this->form_validation->set_rules('animal_name', 'Name', 'required|is_unique[animals.animal_name]');
        $this->form_validation->set_rules('animal_birth', 'Birth Date', 'required');
        $this->form_validation->set_rules('customer_id', 'Customer ID', 'required');
        $this->form_validation->set_rules('type_id', 'Type ID', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/edit_animal', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'animal_name' => $this->input->post('animal_name'),
                'customer_id' => $this->animals_model->getCustomerId($this->input->post('customer_name')),
                'type_id' => $this->animals_model->getTypeId($this->input->post('type_name')),
                'animal_birth' => $this->input->post('animal_birth'),
            ];

            $this->animals_model->updateAnimals($data, $id);
            redirect('animals');
        }
    }
}
