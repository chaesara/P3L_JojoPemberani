<?php


class Employees_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEmployees($id = null)
    {
        if ($id === null) {
            return $this->db->get('employees')->result_array();
        } else {
            return $this->db->get_where('employees', ['employee_id' => $id])->row_array();
        }
    }

    public function deleteEmployees($id)
    {
        $this->db->delete('employees', ['employee_id' => $id]);
        return $this->db->affected_rows();
    }

    public function createEmployees($data)
    {
        $this->db->insert('employees', $data);
        return $this->db->affected_rows();
    }

    public function updateEmployees($data, $id)
    {
        $this->db->update('employees', $data, ['employee_id' => $id]);
        return $this->db->affected_rows();
    }

    public function searchEmployees()
    {
        $keyword = $this->input->post('keyword', true);

        $this->db->select('employees.*, roles.role_name');
        $this->db->join('roles', 'role_id');
        $this->db->from('employees');
        $this->db->like('employee_name', $keyword);

        $query = $this->db->get();

        return $query->result_array();


        // $this->db->like('product_name', $keyword);
        // return $this->db->get('products')->result_array();
    }

    public function get_by_role()
    {
        $this->db->select('employees.*, roles.role_name');
        $this->db->join('roles', 'role_id');
        $this->db->from('employees');

        $query = $this->db->get();

        return $query->result_array();
    }
}
