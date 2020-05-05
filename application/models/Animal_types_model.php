<?php


class Animal_types_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAnimal_types($id = null)
    {
        if ($id === null) {
            return $this->db->get('animal_types')->result_array();
        } else {
            return $this->db->get_where('animal_types', ['animal_type_id' => $id])->row_array();
        }
    }

    public function get_by_employee()
    {
        $this->db->select('animal_types.*, employees.employee_name');
        $this->db->join('employees', 'employee_id');
        $this->db->from('animal_types');

        $query = $this->db->get();

        return $query->result_array();
    }

    // Delete - insert now timestamp to deleted_at
    public function deleteAnimal_types($id)
    {
        date_default_timezone_set('Asia/Karachi'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        $this->db->update('animal_types', $data, ['animal_type_id' => $id]);
    }

    // Actually delete data from database
    // public function deleteCustomers($id)
    // {
    //     $this->db->delete('customers', ['customer_id' => $id]);
    //     return $this->db->affected_rows();
    // }

    public function createAnimal_types($data)
    {
        $this->db->insert('animal_types', $data);
        return $this->db->affected_rows();
    }

    public function updateAnimal_types($data, $id)
    {
        $this->db->update('animal_types', $data, ['animal_type_id' => $id]);
        return $this->db->affected_rows();
    }

    public function searchAnimal_types()
    {
        $keyword = $this->input->post('keyword', true);

        $this->db->select('animal_types.*, employees.employee_name');
        $this->db->join('employees', 'employee_id');
        $this->db->from('animal_types');
        $this->db->like('animal_type_name', $keyword);

        $query = $this->db->get();

        return $query->result_array();
    }
}
