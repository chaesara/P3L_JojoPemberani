<?php

use chriskacerguis\RestServer\RestController;

class Transactions_pr extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transactions_model', 'transactions_model');
    }

    public function index_delete()
    {
        $id = $this->delete('transaction_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->transactions_model->deleteProductTransactions($id) > 0) {
                $this->response([
                    'status' => true,
                    'supplier_id' => $id,
                    'message' => 'deleted'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], 404);
            }
        }
    }

    public function index_patch()
    {
        $id = $this->patch('transaction_id');

        if ($this->transactions_model->deleteProductTransactions($id) > 0) {
            $this->response([
                'status' => true,
                'transaction_id' => $id,
                'message' => 'deleted'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'transaction_id' => $id,
                'message' => 'id not found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'employee_id_cs' => $this->post('employee_id_cs'),
            'employee_id_cashier' => '1',
            'customer_id' => $this->post('customer_id'),
            'transaction_status' => 'Draft',
            'transaction_discount' => '0',
            'transaction_subtotal' => '0',
            'transaction_total' => '0'
        ];

        if ($this->transactions_model->createProductTransactions($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Product transaction has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'create product transaction failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('transaction_id');

        if ($this->transactions_model->proceedTransaction($id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'product transaction has been sent'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'send product transaction failed'
            ], 404);
        }
    }
}
