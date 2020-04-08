<?php 

class Landing extends CI_Controller {

    public function index() {
        $data['title'] = 'Kouvee Pet Shop';

        $this->load->view('templates/header', $data);
        $this->load->view('landing');
        $this->load->view('templates/footer');
    }

}