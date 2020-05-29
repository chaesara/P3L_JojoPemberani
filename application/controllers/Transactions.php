<?php


class Transactions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transactions_model', 'transactions_model');
    }

    public function index()
    {
        $data['title'] = 'Transactions :: Kouvee';
        $data['transactions'] = $this->transactions_model->getTransactions();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/transactions/transactions', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_product_transactions()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Transaction : Product';
        $data['customers'] = $this->transactions_model->getCustomers();

        $this->form_validation->set_rules('customer_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/transactions/add_tr_product', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id_cs' => $data['user']['employee_id'],
                'employee_id_cashier' => '1',
                'customer_id' => $this->transactions_model->getCustomerId($this->input->post('customer_name')),
                'transaction_status' => 'Not Yet'
            ];
            $id = $this->transactions_model->createProductTransactions($data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Product Transaction added !
          </div>');
            redirect('transactions/detail_transaction_pr/' . $id);
        }
    }

    public function add_service_transactions()
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Transaction : Service';
        $data['customers'] = $this->transactions_model->getCustomers();

        $this->form_validation->set_rules('customer_name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/transactions/add_tr_product', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'employee_id_cs' => $data['user']['employee_id'],
                'employee_id_cashier' => '1',
                'customer_id' => $this->transactions_model->getCustomerId($this->input->post('customer_name')),
                'transaction_status' => 'Not Yet'
            ];
            $id = $this->transactions_model->createServiceTransactions($data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Service Transaction added !
          </div>');
            redirect('transactions/detail_transaction_sr/' . $id);
        }
    }

    public function add_product_details($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Product Transaction';
        $data['transaction'] = $this->transactions_model->getTransactions($id);
        $data['products'] = $this->transactions_model->getProducts();

        $this->form_validation->set_rules('transaction_product_quantity', 'Quantity', 'required|numeric|callback_qty_check');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/transactions/add_det_product', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'transaction_id' => $id,
                'product_id' => $this->transactions_model->getProductId($this->input->post('product_name')),
                'transaction_product_quantity' => $this->input->post('transaction_product_quantity'),
                'transaction_product_subtotal' => $this->transactions_model->countSubtotal($this->input->post('product_name'), $this->input->post('transaction_product_quantity'))
            ];
            $this->transactions_model->createProductDetails($data);
            // Generate PO Code
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Product Detail added !
          </div>');
            redirect('transactions/detail_transaction_pr/' . $id);
        }
    }

    public function qty_check($qty_input)
    {
        $pr_name = $this->input->post('product_name');
        $stock = $this->db->get_where('products', ['product_name' => $pr_name])->row()->product_quantity;
        if ($qty_input <= $stock) {
            return true;
        } else {
            $this->form_validation->set_message('qty_check', 'Insufficient Product!');
            return false;
        }
    }

    public function edit_product_details($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['detail'] = $this->transactions_model->getProductDetails($id);
        $data['transaction'] = $this->transactions_model->getTransactions($data['detail']['transaction_id']);
        $data['title'] = 'Edit Product : ' . $data['detail']['product_name'];;
        $data['products'] = $this->transactions_model->getProducts();

        $transaction_id = $data['detail']['transaction_id'];
        $product_name = $data['detail']['product_name'];

        $this->form_validation->set_rules('transaction_product_quantity', 'Quantity', 'required|numeric|callback_qty_check');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/transactions/edit_det_product', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'transaction_product_quantity' => $this->input->post('transaction_product_quantity'),
                'transaction_product_subtotal' => $this->transactions_model->countSubtotal($product_name, $this->input->post('transaction_product_quantity'))
            ];
            $this->transactions_model->updateProductDetails($data, $id);
            // Generate PO Code
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Product detail updated !
          </div>');
            redirect('transactions/detail_transaction_pr/' . $transaction_id);
        }
    }

    public function delete_product_details($id)
    {
        $data['detail'] = $this->transactions_model->getProductDetails($id);
        $transaction_id = $data['detail']['transaction_id'];

        $this->transactions_model->deleteProductDetails($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Product detail deleted !
          </div>');

        redirect('transactions/detail_transaction_pr/' . $transaction_id);
    }

    public function detail_transaction_pr($id)
    {
        $data['transaction'] = $this->transactions_model->getTransactions($id);
        $data['details'] = $this->transactions_model->getAllProductDetails($id);
        $data['title'] = $data['transaction']['transaction_code'] . ' | ' . $data['transaction']['customer_name'] . ' :: Kouvee';

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/transactions/detail_product_tr', $data);
        $this->load->view('templates/admin_footer');
    }

    public function detail_transaction_sr($id)
    {
        $data['transaction'] = $this->transactions_model->getTransactions($id);
        $data['details'] = $this->transactions_model->getAllServiceDetails($id);
        $data['title'] = $data['transaction']['transaction_code'] . ' | ' . $data['transaction']['customer_name'] . ' :: Kouvee';

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/transactions/detail_service_tr', $data);
        $this->load->view('templates/admin_footer');
    }

    public function send_transaction_pr($id)
    {
        $data['transaction'] = $this->transactions_model->getTransactions($id);
        $data['details'] = $this->transactions_model->getAllProductDetails($id);
        $tr_status = $data['transaction']['transaction_status'];
        if ($tr_status === 'Draft') {
            $products = $data['details'];

            foreach ($products as $p) {
                $this->transactions_model->updateProduct($p['product_id'], $p['transaction_product_quantity']);
            };
            $this->transactions_model->proceedTransaction($id);
        }
        redirect('transactions');
    }

    public function cancel_transaction_pr($id)
    {
        $this->transactions_model->deleteProductTransactions($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Product transaction deleted !
          </div>');
        redirect('transactions');
    }

    public function cancel_transaction_sr($id)
    {
        $this->transactions_model->deleteServiceTransactions($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Service transaction deleted !
          </div>');
        redirect('transactions');
    }
}
