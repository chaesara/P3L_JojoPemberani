<?php


class AnimalTypes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAnimalTypes($id = null)
    {
        if ($id === null) {
            return $this->db->get('animal_types')->result_array();
        } else {
            return $this->db->get_where('animal_types', ['type_id' => $id])->row_array();
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
    public function deleteAnimalTypes($id)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        return $this->db->update('animal_types', $data, ['type_id' => $id]);
    }

    // Actually delete data from database
    // public function deleteAnimalTypes($id)
    // {
    //     $this->db->delete('animal_types', ['type_id' => $id]);
    //     return $this->db->affected_rows();
    // }

    public function createAnimalTypes($data)
    {
        $this->db->insert('animal_types', $data);
        return $this->db->affected_rows();
    }

    public function updateAnimalTypes($data, $id)
    {
        $this->db->update('animal_types', $data, ['type_id' => $id]);
        return $this->db->affected_rows();
    }
}
