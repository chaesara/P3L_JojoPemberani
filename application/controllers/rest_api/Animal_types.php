<?php

use chriskacerguis\RestServer\RestController;

class Animal_types extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Animal_types_model', 'animal_types');
    }

    public function index_get()
    {
        $id = $this->get('animal_type_id');

        if ($id === null) {
            $animal_types = $this->animal_types->getAnimal_types();
        } else {
            $animal_types = $this->animal_types->getAnimal_types($id);
        }

        if ($animal_types) {
            // Set the response and exit
            $this->response($animal_types, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No animal_types were found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('animal_type_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->animal_types->deleteAnimal_types($id) > 0) {
                $this->response([
                    'status' => true,
                    'animal_type_id' => $id,
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
            'animal_type_id' => $this->post('animal_type_id'),
            'employee_id' => $this->post('employee_id'),
            'animal_type_name' => $this->post('animal_type_name')
        ];

        if ($this->animal_types->createAnimal_types($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'animal_type has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'create animal_type failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('animal_type_id');

        $data = [
            'animal_type_name' => $this->put('animal_type_name')
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'No such animal_type found'
            ], 404);
        } else {
            if ($this->animal_types->updateAnimal_types($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'animal_type has been updated'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'update animal_type failed'
                ], 404);
            }
        }
    }
}
