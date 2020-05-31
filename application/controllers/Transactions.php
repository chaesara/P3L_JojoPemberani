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
                'transaction_status' => 'Draft',
                'transaction_discount' => '0',
                'transaction_subtotal' => '0',
                'transaction_total' => '0'
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
                'transaction_status' => 'Draft',
                'transaction_discount' => '0',
                'transaction_subtotal' => '0',
                'transaction_total' => '0'
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
                'transaction_product_subtotal' => $this->transactions_model->countSubtotal_pr($this->input->post('product_name'), $this->input->post('transaction_product_quantity'))
            ];
            // Input data Product Detail
            $this->transactions_model->createProductDetails($data);
            // Update products stock
            $this->transactions_model->updateProduct($this->transactions_model->getProductId($this->input->post('product_name')), $this->input->post('transaction_product_quantity'));
            // Count transaction subtotal
            $this->transactions_model->countTransactionSubTotal_pr($id);
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

    public function add_service_details($id)
    {
        $data['user'] = $this->db->get_where('employees', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Add Service Transaction';
        $data['transaction'] = $this->transactions_model->getTransactions($id);
        $data['service'] = $this->transactions_model->getServices();

        $this->form_validation->set_rules('transaction_product_quantity', 'Quantity', 'required|numeric|callback_qty_check');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/transactions/add_det_service', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'transaction_id' => $id,
                'product_id' => $this->transactions_model->getProductId($this->input->post('product_name')),
                'transaction_product_quantity' => $this->input->post('transaction_product_quantity'),
                'transaction_product_subtotal' => $this->transactions_model->countSubtotal($this->input->post('product_name'), $this->input->post('transaction_product_quantity'))
            ];
            // Input data Product Detail
            $this->transactions_model->createProductDetails($data);
            // Update service stock
            $this->transactions_model->updateProduct($this->transactions_model->getProductId($this->input->post('product_name')), $this->input->post('transaction_product_quantity'));
            // Generate PO Code
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Product Detail added !
          </div>');
            redirect('transactions/detail_transaction_pr/' . $id);
        }
    }

    public function add_discount($id)
    {
        $data['title'] = 'Discount Transaction';
        $data['transaction'] = $this->transactions_model->getTransactions($id);

        $transaction_id = $data['transaction']['transaction_id'];
        $transaction_code = $data['transaction']['transaction_code'];

        $this->form_validation->set_rules('transaction_discount', 'Discount', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/transactions/add_discount', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'transaction_discount' => $this->input->post('transaction_discount')
            ];
            $this->transactions_model->updateTransactions($data, $id);
            // Count Transaction total
            $this->transactions_model->countTotal($id);
            // Generate PO Code
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Discount updated !
          </div>');
            if (substr($transaction_code, 0, 2) === 'PR') {
                redirect('transactions/detail_transaction_pr/' . $transaction_id);
            } else {
                redirect('transactions/detail_transaction_sr/' . $transaction_id);
            }
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
        $product_id = $data['detail']['product_id'];
        $detail_qty = $data['detail']['transaction_product_quantity'];
        $product_name = $data['detail']['product_name'];

        $this->form_validation->set_rules('transaction_product_quantity', 'Quantity', 'required|numeric|callback_qty_check_edit');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/transactions/edit_det_product', $data);
            $this->load->view('templates/admin_footer');
        } else {
            // Revert product stock
            $this->transactions_model->revertProduct($product_id, $detail_qty);
            $data = [
                'transaction_product_quantity' => $this->input->post('transaction_product_quantity'),
                'transaction_product_subtotal' => $this->transactions_model->countSubtotal_pr($product_name, $this->input->post('transaction_product_quantity'))
            ];
            $this->transactions_model->updateProductDetails($data, $id);
            // Update products stock
            $this->transactions_model->updateProduct($product_id, $this->input->post('transaction_product_quantity'));
            // Count transaction subtotal
            $this->transactions_model->countTransactionSubTotal_pr($transaction_id);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Product detail updated !
          </div>');
            redirect('transactions/detail_transaction_pr/' . $transaction_id);
        }
    }

    public function qty_check_edit($qty_input)
    {
        $pr_id = $this->input->post('product_id');
        $b4 = $this->input->post('quantity_before');
        $stock = $this->db->get_where('products', ['product_id' => $pr_id])->row()->product_quantity;
        if ($qty_input <= ($stock + $b4)) {
            return true;
        } else {
            $this->form_validation->set_message('qty_check_edit', 'Insufficient Product!');
            return false;
        }
    }

    public function delete_product_details($id)
    {
        $data['detail'] = $this->transactions_model->getProductDetails($id);
        $transaction_id = $data['detail']['transaction_id'];
        $product_id = $data['detail']['product_id'];
        $detail_qty = $data['detail']['transaction_product_quantity'];

        // Revert product stock
        $this->transactions_model->revertProduct($product_id, $detail_qty);
        // Count transaction subtotal
        $this->transactions_model->countTransactionSubTotal_pr($transaction_id);
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
            $this->transactions_model->proceedTransaction($id);
            $this->transactions_model->countTotal($id);
        }
        redirect('transactions');
    }

    public function send_payment($id)
    {
        $data['transaction'] = $this->transactions_model->getTransactions($id);
        $transaction_code = $data['transaction']['transaction_code'];
        $tr_date = $data['transaction']['UPDATED_AT'];

        $data['print_date'] = date("d-M-Y H:i", strtotime($tr_date));  

        // Details get
        if (substr($transaction_code, 0, 2) === 'PR') {
            $data['details'] = $this->transactions_model->getAllProductDetails($id);
        } else {
            $data['details'] = $this->transactions_model->getAllServiceDetails($id);
        }

        // Set to Paid
        $tr_status = $data['transaction']['transaction_status'];
        if($tr_status === 'Not Yet') {
            $this->transactions_model->proceedPayment($id);
        }

        // Print Nota
        $this->load->library('pdfgenerator');
        $html = $this->load->view('admin/transactions/print_transaction', $data, true);
        $this->pdfgenerator->generate($html, 'Transaction : ' . $transaction_code);

        //redirect('transactions');
    }

    public function cancel_transaction_pr($id)
    {
        $details = $this->transactions_model->getAllProductDetails($id);
        foreach ($details as $d) {
            $this->transactions_model->revertProduct($d['product_id'], $d['transaction_product_quantity']);
        };
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
