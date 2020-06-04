<?php


class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model', 'products_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Products :: Kouvee';

        $data['products'] = $this->products_model->get_by_employee();

        if ($this->input->post('keyword')) {
            $data['products'] = $this->products_model->searchProducts();
        }

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/products', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_products()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Product';

        $this->form_validation->set_rules('product_name', 'Name', 'required|is_unique[products.product_name]');
        $this->form_validation->set_rules('product_price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('product_quantity', 'Qty', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            // $this->load->view('admin/add_product_copy', $data);
            $this->load->view('admin/add_product', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'product_name' => $this->input->post('product_name'),
                'product_price' => $this->input->post('product_price'),
                'product_quantity' => $this->input->post('product_quantity'),
                'image' => $this->_uploadImage($this->input->post('product_name'), 0)
            ];
            $this->products_model->createProducts($data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Product added !
          </div>');
            redirect('products');
        }
    }

    public function delete_products($id)
    {
        $this->products_model->deleteProducts($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Product deleted !
          </div>');
        redirect('products');
    }

    public function edit_products($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Edit Product';
        $data['product'] = $this->products_model->getProducts($id);

        $this->form_validation->set_rules('product_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/edit_product', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'product_name' => $this->input->post('product_name'),
                'product_price' => $this->input->post('product_price'),
                'product_quantity' => $this->input->post('product_quantity'),
                'image' => $this->_uploadImage($this->input->post('product_name'), 1)
            ];

            $this->products_model->updateProducts($data, $id);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Product updated !
          </div>');
            redirect('products');
        }
    }

    private function _uploadImage($imgName, $edit)
    {
        $config['upload_path']          = './assets/products';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 3000;
        $config['file_name']            = $imgName;
        $config['overwrite']            = true;
        //$config['encrypt_name']         = true;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('imgInp')) {
            return $this->upload->data('file_name');
        } else {
            if ($edit != '1') {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Select an image
              </div>');
                redirect('products/add_products');
            }
        }
    }
}
