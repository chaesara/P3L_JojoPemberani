<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    //user  = variabel baru di controller
    //users = nama tabel di database Kouvee
    public function index()
    {
        //$user = $this->db->get_where('employees', ['employee_id' => $this->session->userdata('employee_id')])->row_array();
        $data['role'] = $this->db->get_where('roles', ['role_id' => $this->session->userdata('role_id')])->row_array();

        if ($this->session->userdata('role_id') != NULL) {
            $data['title'] = 'Kouevee :: ' . $data['role']['role_name'] . ' Page';

            $this->load->view('templates/admin_header', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/admin_footer');
        } else {
            redirect('auth');
        }

        // if ($this->session->userdata('employee_id') === null) {
        //     redirect('auth');
        // } else {
        //     $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        //     $user = $this->db->get_where('employees', ['employee_id' => $this->session->userdata('employee_id')])->row_array();
        //     $data['role'] = $this->db->get_where('roles', ['role_id' => $user['role_id']])->row_array();

        //     echo 'Hello kamu ' . $data['user']['username'] . ' si ' . $data['role']['role_name'];

        //     $data['title'] = 'Kouevee | ' . $data['role']['role_name'] . ' Page';

        //     $this->load->view('templates/admin_header', $data);
        //     $this->load->view('user/index');
        //     $this->load->view('templates/admin_footer');
        // }
    }
}
