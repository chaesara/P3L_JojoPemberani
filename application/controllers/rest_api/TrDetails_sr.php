<?php

use chriskacerguis\RestServer\RestController;

class TrDetails_sr extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transactions_model', 'transactions_model');
    }

    public function index_get()
    {
        $id = $this->get('transaction_id');
        $det_id = $this->get('transaction_service_id');

        if ($det_id === null) {
            $details = $this->transactions_model->getAllServiceDetails($id);
        } else {
            $details = $this->transactions_model->getServiceDetails($det_id);
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
        $id = $this->delete('transaction_service_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->transactions_model->deleteServiceDetails($id) > 0) {
                $this->response([
                    'status' => true,
                    'transaction_service_id' => $id,
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
        $id = $this->patch('transaction_service_id');

        if ($this->transactions_model->deleteServiceDetails($id) > 0) {
            $this->response([
                'status' => true,
                'transaction_service_id' => $id,
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
            'service_id' => $this->post('service_id'),
            'animal_id' => $this->post('animal_id'),
            'transaction_service_quantity' => $this->post('transaction_service_quantity'),
            'transaction_service_subtotal' => $this->post('transaction_service_subtotal')
        ];

        if ($this->transactions_model->createServiceDetails($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'service transaction detail has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'service transaction detail failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('transaction_service_id');

        $data = [
            'transaction_id' => $this->put('transaction_id'),
            'product_id' => $this->put('product_id'),
            'animal_id' => $this->put('animal_id'),
            'transaction_service_quantity' => $this->put('transaction_service_quantity'),
            'transaction_service_subtotal' => $this->put('transaction_service_subtotal')
        ];

        if ($this->transactions_model->updateServiceDetails($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'service transaction detail has been updated'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'update service transaction detail failed'
            ], 404);
        }
    }
}
