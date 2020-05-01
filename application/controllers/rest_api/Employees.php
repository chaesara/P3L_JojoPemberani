<?php

use chriskacerguis\RestServer\RestController;

class Employees extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employees_model');
    }

    public function index_get()
    {
        $id = $this->get('employee_id');

        if ($id === null) {
            $employee = $this->Employees_model->getEmployees();
        } else {
            $employee = $this->Employees_model->getEmployees($id);
        }

        if ($employee) {
            // Set the response and exit
            $this->response($employee, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No employee were found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('employee_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'No such user found'
            ], 404);
        } else {
            if ($this->Employees_model->deleteEmployees($id) > 0) {
                $this->response([
                    'status' => true,
                    'employee_id' => $id,
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
            'role_id' => $this->post('role_id'),
            'employee_name' => $this->post('employee_name'),
            'employee_address' => $this->post('employee_address'),
            'employee_phoneno' => $this->post('employee_phoneno'),
            'employee_birth' => $this->post('employee_birth'),
            'username' => htmlspecialchars($this->post('username', true)),
            'password' => password_hash($this->post('password'), PASSWORD_DEFAULT)

        ];

        if ($this->Employees_model->createEmployees($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'employee has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'create employee failed'
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('employee_id');

        $data = [
            'role_id' => $this->put('role_id'),
            'employee_name' => $this->put('employee_name'),
            'employee_address' => $this->put('employee_address'),
            'employee_phoneno' => $this->put('employee_phoneno'),
            'employee_birth' => $this->put('employee_birth'),
            'username' => htmlspecialchars($this->put('username', true)),
            'password' => password_hash($this->put('password'), PASSWORD_DEFAULT)
        ];

        if ($this->Employees_model->updateEmployees($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'employee has been updated'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'update employee failed'
            ], 404);
        }
    }
}
