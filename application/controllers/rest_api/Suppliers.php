<?php

use chriskacerguis\RestServer\RestController;

class Suppliers extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Suppliers_model', 'suppliers');
    }

    public function index_get()
    {
        $id = $this->get('supplier_id');

        if ($id === null) {
            $suppliers = $this->suppliers->getSuppliers();
        } else {
            $suppliers = $this->suppliers->getSuppliers($id);
        }

        if ($suppliers) {
            // Set the response and exit
            $this->response($suppliers, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No suppliers were found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('supplier_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->suppliers->deleteSuppliers($id) > 0) {
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

    public function index_post()
    {
        $data = [
            'supplier_id' => $this->post('supplier_id'),
            'employee_id' => $this->post('employee_id'),
            'supplier_name' => $this->post('supplier_name'),
            'supplier_address' => $this->post('supplier_address'),
            'supplier_phoneno' => $this->post('supplier_phoneno')
        ];

        if ($this->suppliers->createSuppliers($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'supplier has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'create supplier failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('supplier_id');

        $data = [
            'supplier_name' => $this->put('supplier_name'),
            'supplier_address' => $this->put('supplier_address'),
            'supplier_phoneno' => $this->put('supplier_phoneno')
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'No such supplier found'
            ], 404);
        } else {
            if ($this->suppliers->updateSuppliers($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'supplier has been updated'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'update supplier failed'
                ], 404);
            }
        }
    }
}
