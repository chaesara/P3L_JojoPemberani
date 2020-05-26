<?php

use chriskacerguis\RestServer\RestController;

class Products extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model', 'products');
    }

    public function index_get()
    {
        $id = $this->get('product_id');

        if ($id === null) {
            $products = $this->products->getProducts();
        } else {
            $products = $this->products->getProducts($id);
        }

        if ($products) {
            // Set the response and exit
            $this->response($products, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No product were found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('product_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->products->deleteProducts($id) > 0) {
                $this->response([
                    'status' => true,
                    'product_id' => $id,
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
        $id = $this->patch('product_id');

        if ($this->products->deleteProducts($id) > 0) {
            $this->response([
                'status' => true,
                'product_id' => $id,
                'message' => 'deleted'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'product_id' => $id,
                'message' => 'id not found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'employee_id' => $this->post('employee_id'),
            'product_name' => $this->post('product_name'),
            'product_price' => $this->post('product_price'),
            'product_quantity' => $this->post('product_quantity'),
            'product_min' => $this->post('product_min'),
            'image' => $this->post('image')
        ];

        if ($this->products->createProducts($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'product has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'create product failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('product_id');

        $data = [
            'product_name' => $this->put('product_name'),
            'product_price' => $this->put('product_price'),
            'product_quantity' => $this->put('product_quantity'),
            'image' => $this->put('image')
        ];
        if ($this->products->updateProducts($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'product has been updated'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'update product failed'
            ], 404);
        }
    }
}
