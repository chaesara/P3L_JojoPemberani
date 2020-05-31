<?php

use chriskacerguis\RestServer\RestController;

class Transactions extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transactions_model', 'transactions_model');
    }

    public function index_get()
    {
        $id = $this->get('transaction_id');

        if ($id === null) {
            $transactions = $this->transactions_model->getTransactions();
        } else {
            $transactions = $this->transactions_model->getTransactions($id);
        }

        if ($transactions) {
            $this->response($transactions, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No transactions were found'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('transaction_id');

        $data = [
            'transaction_discount' => $this->put('transaction_discount')
        ];

        if ($this->transactions_model->updateTransactions($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'transaction discount has been updated'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'send transaction discount order failed'
            ], 404);
        }
    }
}
