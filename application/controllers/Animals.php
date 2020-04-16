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
        $data['title'] = 'Animals :: Kouvee';
        $data['animals'] = $this->animals_model->get_by_employee();
        
        if ($this->input->post('keyword')) {
            $data['animals'] = $this->animals_model->searchAnimals();
        }

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/animals', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_animals()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Animal';

        $this->form_validation->set_rules('service_name', 'Name', 'required|is_unique[services.service_name]');
        $this->form_validation->set_rules('service_price', 'Price', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/add_service', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
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
}
