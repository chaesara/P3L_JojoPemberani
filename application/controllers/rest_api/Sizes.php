<?php

use chriskacerguis\RestServer\RestController;

class Sizes extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sizes_model', 'sizes');
    }

    public function index_get()
    {
        $id = $this->get('size_id');

        if ($id === null) {
            $sizes = $this->sizes->getSizes();
        } else {
            $sizes = $this->sizes->getSizes($id);
        }

        if ($sizes) {
            // Set the response and exit
            $this->response($sizes, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No sizes were found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('size_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->sizes->deleteSizes($id) > 0) {
                $this->response([
                    'status' => true,
                    'size_id' => $id,
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
            'employee_id' => $this->post('employee_id'),
            'size_name' => $this->post('size_name')
        ];

        if ($this->sizes->createSizes($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'size has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'create size failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('size_id');

        $data = [
            'employee_id' => $this->put('employee_id'),
            'size_name' => $this->put('size_name')
        ];

        if ($this->sizes->updateSizes($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'size has been updated'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'update size failed'
            ], 404);
        }
    }
}
