<?php

use chriskacerguis\RestServer\RestController;

class Animals extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Animals_model', 'animals');
    }

    public function index_get()
    {
        $id = $this->get('animal_id');

        if ($id === null) {
            $animals = $this->animals->getAnimals();
        } else {
            $animals = $this->animals->getAnimals($id);
        }

        if ($animals) {
            // Set the response and exit
            $this->response($animals, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No animals were found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('animal_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an ID !'
            ], 404);
        } else {
            if ($this->animals->deleteAnimals($id) > 0) {
                $this->response([
                    'status' => true,
                    'animal_id' => $id,
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
            'animal_id' => $this->post('animal_id'),
            'employee_id' => $this->post('employee_id'),
            'type_id' => $this->post('type_id'),
            'customer_id' => $this->post('customer_id'),
            'animal_name' => $this->post('animal_name'),
            'animal_birth' => $this->post('animal_birth')
        ];

        if ($this->animals->createAnimals($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'animal has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'create animal failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('animal_id');

        $data = [
            'animal_id' => $this->post('animal_id'),
            'employee_id' => $this->post('employee_id'),
            'type_id' => $this->post('type_id'),
            'customer_id' => $this->post('customer_id'),
            'animal_name' => $this->post('animal_name'),
            'animal_birth' => $this->post('animal_birth')
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'No such animal found'
            ], 404);
        } else {
            if ($this->animals->updateAnimals($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'animal has been updated'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'update animal failed'
                ], 404);
            }
        }
    }
}
