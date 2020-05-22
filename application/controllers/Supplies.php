<?php


class Supplies extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Supplies_model', 'supplies_model');
    }

    public function index()
    {
        $data['title'] = 'Order Supplies :: Kouvee';
        $data['supplies'] = $this->supplies_model->get_by_employee();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/supplies/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_supplies()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Supply Order';
        $data['suppliers'] = $this->supplies_model->getSuppliers();

        $this->form_validation->set_rules('supplier_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/supplies/add_supply', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id' => $data['user']['employee_id'],
                'supplier_id' => $this->supplies_model->getSupplierId($this->input->post('supplier_name')),
                'supply_status' => 'Draft'
            ];
            $this->supplies_model->createSupplies($data);
            // Generate PO Code
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Supply Order added !
          </div>');
            redirect('supplies');
        }
    }

    public function add_details($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Supply Order';
        $data['supply'] = $this->supplies_model->get_by_employee($id);
        $data['products'] = $this->supplies_model->getProducts();

        $this->form_validation->set_rules('supply_detail_quantity', 'Quantity', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/supplies/add_detail', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'supply_id' => $id,
                'product_id' => $this->supplies_model->getProductId($this->input->post('product_name')),
                'supply_detail_quantity' => $this->input->post('supply_detail_quantity'),
                'supply_detail_package' => $this->input->post('supply_detail_package'),
                'supply_detail_subtotal' => $this->supplies_model->countSubtotal($this->input->post('product_name'), $this->input->post('supply_detail_quantity'))
            ];
            $this->supplies_model->createDetails($data);
            // Generate PO Code
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Supply Order added !
          </div>');
            redirect('supplies/detail_supplies/' . $id);
        }
    }

    public function edit_details($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['detail'] = $this->supplies_model->getDetails($id);
        $data['supply'] = $this->supplies_model->get_by_employee($data['detail']['supply_id']);
        $data['title'] = 'Edit Supply Detail';
        $data['products'] = $this->supplies_model->getProducts();

        $supply_id = $data['detail']['supply_id'];
        $product_name = $data['detail']['product_name'];

        $this->form_validation->set_rules('supply_detail_quantity', 'Quantity', 'required|numeric');
        $this->form_validation->set_rules('supply_detail_package', 'Packaging', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/supplies/edit_detail', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'supply_detail_quantity' => $this->input->post('supply_detail_quantity'),
                'supply_detail_package' => $this->input->post('supply_detail_package'),
                'supply_detail_subtotal' => $this->supplies_model->countSubtotal($product_name, $this->input->post('supply_detail_quantity'))
            ];
            $this->supplies_model->updateDetails($data, $id);
            // Generate PO Code
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Supply Order updated !
          </div>');
            redirect('supplies/detail_supplies/' . $supply_id);
        }
    }

    public function detail_supplies($id)
    {
        $data['supply'] = $this->supplies_model->get_by_employee($id);
        $data['details'] = $this->supplies_model->getAllDetails($id);
        $data['title'] = $data['supply']['supply_code'] . ' | ' . $data['supply']['supplier_name'] . ' :: Kouvee';

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/supplies/detail_supply', $data);
        $this->load->view('templates/admin_footer');
    }

    public function send_supplies($id)
    {
        $data['supply'] = $this->supplies_model->get_by_employee($id);
        $data['details'] = $this->supplies_model->getAllDetails($id);
        $sup_status = $data['supply']['supply_status'];
        if ($sup_status === 'Draft') {
            $products = $data['details'];

            foreach ($products as $p) {
                $this->supplies_model->updateProduct($p['product_id'], $p['supply_detail_quantity']);
            };

            $this->supplies_model->sendSupplies($id);
        }
        redirect('supplies');
    }

    public function print_supplies($id)
    {
        $data['supply'] = $this->supplies_model->get_by_employee($id);
        $data['details'] = $this->supplies_model->getAllDetails($id);

        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $data['print_date'] = date('d F Y');

        $this->load->library('pdfgenerator');

        $supply_code = $data['supply']['supply_code'];
        $html = $this->load->view('admin/supplies/print_supply', $data, true);

        $this->pdfgenerator->generate($html, 'Supply : ' . $supply_code);
    }

    public function pdf_supplies($id)
    {
        $data['supply'] = $this->supplies_model->get_by_employee($id);
        $data['details'] = $this->supplies_model->getAllDetails($id);
        $this->load->view('admin/supplies/print_supply', $data);;
    }
    public function cancel_supplies($id)
    {
        $this->supplies_model->deleteSupplies($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Supply order deleted !
          </div>');
        redirect('supplies');
    }

    public function delete_details($id)
    {
        $data['detail'] = $this->supplies_model->getDetails($id);
        $supply_id = $data['detail']['supply_id'];

        $this->supplies_model->deleteDetails($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Supply detail deleted !
          </div>');

        redirect('supplies/detail_supplies/' . $supply_id);
    }
}
