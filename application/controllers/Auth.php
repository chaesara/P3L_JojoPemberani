<?php


class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Employees_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Kouvee Login';

            $this->load->view('templates/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            $this->_login(); //_ identified as Private Function
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('employees', ['username' => $username])->row_array();
        //var_dump($users);
        //die;
        if ($user['DELETED_AT'] === NULL) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],
                    'employee_id' => $user['employee_id'],
                    'employee_name' => $user['employee_name'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data); //Halaman sesuai role usernya
                redirect('user');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Incorrect Password !
          </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            User not found !
          </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $data = [
            'username',
            'employee_id',
            'employee_name',
            'role_id'
        ];
        $this->session->unset_userdata($data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logged out
          </div>');

        redirect('auth');
    }
}
