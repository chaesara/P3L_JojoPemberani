<?php

use chriskacerguis\RestServer\RestController;

class Customers extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customers_model', 'customers');
    }

    public function index_get()
    {
        $id = $this->get('customer_id');

        if ($id === null) {
            $customers = $this->customers->getCustomers();
        } else {
            $customers = $this->customers->getCustomers($id);
        }

        if ($customers) {
            // Set the response and exit
            $this->response($customers, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No customers were found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('customer_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->customers->deleteCustomers($id) > 0) {
                $this->response([
                    'status' => true,
                    'customer_id' => $id,
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
            'customer_id' => $this->post('customer_id'),
            'employee_id' => $this->post('employee_id'),
            'customer_name' => $this->post('customer_name'),
            'customer_address' => $this->post('customer_address'),
            'customer_phoneno' => $this->post('customer_phoneno'),
            'customer_birth' => $this->post('customer_birth')
        ];

        if ($this->customers->createCustomers($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'customer has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'create customer failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('customer_id');

        $data = [
            'customer_name' => $this->put('customer_name'),
            'customer_address' => $this->put('customer_address'),
            'customer_phoneno' => $this->put('customer_phoneno'),
            'customer_birth' => $this->put('customer_birth')
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'No such customer found'
            ], 404);
        } else {
            if ($this->customers->updateCustomers($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'customer has been updated'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'update customer failed'
                ], 404);
            }
        }
    }
}
