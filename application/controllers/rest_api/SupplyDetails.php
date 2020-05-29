<?php

use chriskacerguis\RestServer\RestController;

class SupplyDetails extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Supplies_model', 'supplies_model');
    }

    public function index_get()
    {
        $id = $this->get('supply_detail_id');

        if ($id === null) {
            $details = $this->supplies_model->getAllDetails();
        } else {
            $details = $this->supplies_model->getDetails($id);
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
        $id = $this->delete('supply_detail_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->supplies_model->deleteDetails($id) > 0) {
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
        $id = $this->patch('supply_detail_id');

        if ($this->supplies_model->deleteDetails($id) > 0) {
            $this->response([
                'status' => true,
                'supplier_id' => $id,
                'message' => 'deleted'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'supplier_id' => $id,
                'message' => 'id not found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'supply_id' => $this->post('supply_id'),
            'product_id' => $this->post('product_id'),
            'supply_detail_quantity' => $this->post('supply_detail_quantity'),
            'supply_detail_package' => $this->post('supply_detail_package'),
            'supply_detail_subtotal' => $this->post('supply_detail_subtotal'),
        ];

        if ($this->supplies_model->createDetails($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'supply order has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'create supply failed'
            ], 404);
        }
    }
}
