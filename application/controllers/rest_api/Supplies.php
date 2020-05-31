<?php

use chriskacerguis\RestServer\RestController;

class Supplies extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Supplies_model', 'supplies_model');
    }

    public function index_get()
    {
        $id = $this->get('supply_id');

        if ($id === null) {
            $supplies = $this->supplies_model->get_by_employee();
        } else {
            $supplies = $this->supplies_model->get_by_employee($id);
        }

        if ($supplies) {
            $this->response($supplies, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No Supplies were found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('supply_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->supplies_model->deleteSupplies($id) > 0) {
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
    
    public function index_put()
    {
        $id = $this->put('supply_id');

        if ($this->supplies_model->sendSupplies($id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'supply order has been sent'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'send supply order failed'
            ], 404);
        }
    }

    public function index_patch()
    {
        $id = $this->patch('supply_id');

        if ($this->supplies_model->deleteSupplies($id) > 0) {
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
            'employee_id' => $this->post('employee_id'),
            'supplier_id' => $this->post('supplier_id'),
            'supply_date' => $this->post('supply_date'),
            'supply_status' => 'Draft'
        ];

        if ($this->supplies_model->createSupplies($data) > 0) {
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

    public function index_put()
    {
        $id = $this->put('supply_id');

        if ($this->supplies_model->sendSupplies($id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'supply order has been sent'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'send supply order failed'
            ], 404);
        }
    }
}
