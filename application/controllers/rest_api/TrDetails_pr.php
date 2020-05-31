<?php

use chriskacerguis\RestServer\RestController;

class TrDetails_pr extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transactions_model', 'transactions_model');
    }

    public function index_get()
    {
        $id = $this->get('transaction_id');
        $det_id = $this->get('transaction_product_id');

        if ($det_id === null) {
            $details = $this->transactions_model->getAllProductDetails($id);
        } else {
            $details = $this->transactions_model->getProductDetails($det_id);
        }

        if ($details) {
            $this->response($details, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No details were found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('transaction_product_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->transactions_model->deleteProductDetails($id) > 0) {
                $this->response([
                    'status' => true,
                    'transaction_product_id' => $id,
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
        $id = $this->patch('transaction_product_id');

        if ($this->transactions_model->deleteProductDetails($id) > 0) {
            $this->response([
                'status' => true,
                'transaction_product_id' => $id,
                'message' => 'deleted'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'transaction-product_id' => $id,
                'message' => 'id not found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'transaction_id' => $this->post('transaction_id'),
            'product_id' => $this->post('product_id'),
            'transaction_product_quantity' => $this->post('transaction_product_quantity'),
            'transaction_product_subtotal' => $this->post('transaction_product_subtotal')
        ];

        if ($this->transactions_model->createProductDetails($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'product transaction detail has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'product transaction detail failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('transaction_product_id');

        $data = [
            'transaction_id' => $this->put('transaction_id'),
            'product_id' => $this->put('product_id'),
            'transaction_product_quantity' => $this->put('transaction_product_quantity'),
            'transaction_product_subtotal' => $this->put('transaction_product_subtotal')
        ];

        if ($this->transactions_model->updateProductDetails($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'product transaction detail has been updated'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'update product transaction detail failed'
            ], 404);
        }
    }
}
