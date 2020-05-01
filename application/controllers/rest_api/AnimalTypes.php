<?php

use chriskacerguis\RestServer\RestController;

class AnimalTypes extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('typeTypes_model', 'types');
    }

    public function index_get()
    {
        $id = $this->get('type_id');

        if ($id === null) {
            $types = $this->types->getAnimalTypes();
        } else {
            $types = $this->types->getAnimalTypes($id);
        }

        if ($types) {
            // Set the response and exit
            $this->response($types, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No types were found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('type_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->types->deleteAnimalTypes($id) > 0) {
                $this->response([
                    'status' => true,
                    'type_id' => $id,
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
            'type_name' => $this->post('type_name'),
        ];

        if ($this->types->createAnimalTypes($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'type has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'create type failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('type_id');

        $data = [
            'employee_id' => $this->post('employee_id'),
            'type_name' => $this->post('type_name'),
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'No such type found'
            ], 404);
        } else {
            if ($this->types->updateAnimalTypes($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'type has been updated'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'update type failed'
                ], 404);
            }
        }
    }
}