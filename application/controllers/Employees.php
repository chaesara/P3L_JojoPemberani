<?php

class Employees extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employees_model', 'employees');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        if ($this->session->userdata('role_id') === '1') {
            $data['title'] = 'Employees :: Kouvee';
            $data['employees'] = $this->employees->get_by_role();
            $data['role'] = ['Owner', 'CS', 'Cashier'];

            //buat search
            if ($this->input->post('keyword')) {
                $data['employees'] = $this->employees->searchEmployees();
            }

            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/employees', $data);
            $this->load->view('templates/admin_footer');
        } else {
            404;
        }
    }

    public function add_employees()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Employee';
        $data['role'] = ['Owner', 'CS', 'Cashier'];

        $this->form_validation->set_rules('employee_name', 'Name', 'required');
        $this->form_validation->set_rules('employee_phoneno', 'Phone Number', 'required|numeric');
        $this->form_validation->set_rules('employee_address', 'Address', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[employees.username]|min_length[2]');
        $this->form_validation->set_rules('password1', 'Password', 'required|min_length[4]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|min_length[4]|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/add_employee');
            $this->load->view('templates/admin_footer');
        } else {
            if ($this->input->post('role') == 'Owner') {
                $role_id = 1;
            } else if ($this->input->post('role') == 'CS') {
                $role_id = 2;
            } else {
                $role_id = 3;
            }

            $data = [
                'role_id' => $role_id,
                'employee_name' => $this->input->post('employee_name'),
                'employee_address' => $this->input->post('employee_address'),
                'employee_phoneno' => $this->input->post('employee_phoneno'),
                'employee_birth' => $this->input->post('employee_birth'),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
            ];
            $this->employees->createEmployees($data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Employee added !
          </div>');
            redirect('employees');
        }
    }

    public function delete_employees($id)
    {
        $this->employees->deleteEmployees($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Employee deleted !
          </div>');
        redirect('employees');
    }

    public function edit_employees($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Edit Employee';
        $data['employee'] = $this->employees->getEmployees($id);
        $data['role'] = ['Owner', 'CS', 'Cashier'];

        $this->form_validation->set_rules('employee_name', 'Name', 'required');
        $this->form_validation->set_rules('employee_phoneno', 'Phone Number', 'required|numeric');
        $this->form_validation->set_rules('employee_address', 'Address', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[employees.username]|min_length[3]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/edit_employee', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_name' => $this->input->post('employee_name'),
                'employee_address' => $this->input->post('employee_address'),
                'employee_phoneno' => $this->input->post('employee_phoneno'),
                'employee_birth' => $this->input->post('employee_birth'),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
            ];

            $this->employees->updateEmployees($data, $id);
            redirect('employees');
        }
    }
}
