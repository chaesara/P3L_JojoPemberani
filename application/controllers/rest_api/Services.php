<?php

use chriskacerguis\RestServer\RestController;

class Services extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Services_model', 'services');
    }

    public function index_get()
    {
        $id = $this->get('service_id');

        if ($id === null) {
            $services = $this->services->getServices();
        } else {
            $services = $this->services->getServices($id);
        }

        if ($services) {
            // Set the response and exit
            $this->response($services, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No services were found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('service_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->services->deleteServices($id) > 0) {
                $this->response([
                    'status' => true,
                    'service_id' => $id,
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
        $id = $this->patch('service_id');

        if ($this->services->deleteServices($id) > 0) {
            $this->response([
                'status' => true,
                'service_id' => $id,
                'message' => 'deleted'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'service_id' => $id,
                'message' => 'id not found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'employee_id' => $this->post('employee_id'),
            'size_id' => $this->post('size_id'),
            'service_name' => $this->post('service_name'),
            'service_price' => $this->post('service_price')
        ];

        if ($this->services->createServices($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'service has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'create service failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('service_id');

        $data = [
            'employee_id' => $this->put('employee_id'),
            'size_id' => $this->put('size_id'),
            'service_name' => $this->put('service_name'),
            'service_price' => $this->put('service_price')
        ];

        if ($this->services->updateServices($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'service has been updated'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'update service failed'
            ], 404);
        }
    }
}
