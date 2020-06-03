<?php

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model', 'products_model');
        $this->load->model('Services_model', 'services_model');
    }

    public function index()
    {
        $data['title'] = 'Kouvee Pet Shop';
    }

    public function menu_products($by = 'default')
    {
        $data['title'] = 'Kouvee :: Products';
        $data['products'] = $this->products_model->getProductsSortBy($by);

        $this->load->view('templates/header', $data);
        $this->load->view('main/products', $data);
        $this->load->view('templates/footer');
    }

    public function menu_about()
    {
        $data['title'] = 'Kouvee :: About Us';

        $this->load->view('templates/header', $data);
        $this->load->view('main/about', $data);
        $this->load->view('templates/footer');
    }
}
