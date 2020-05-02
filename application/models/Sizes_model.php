<?php


class Sizes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getSizes($id = null)
    {
        if ($id === null) {
            return $this->db->get('sizes')->result_array();
        } else {
            return $this->db->get_where('sizes', ['size_id' => $id])->row_array();
        }
    }

    public function get_by_employee()
    {
        $this->db->select('sizes.*, employees.employee_name');
        $this->db->join('employees', 'employee_id');
        $this->db->from('sizes');

        $query = $this->db->get();

        return $query->result_array();
    }

    // Delete - insert now timestamp to deleted_at
    public function deleteSizes($id)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        $this->db->update('sizes', $data, ['size_id' => $id]);
        return $this->db->affected_rows();
    }


    public function createSizes($data)
    {
        $this->db->insert('sizes', $data);
        return $this->db->affected_rows();
    }

    public function updateSizes($data, $id)
    {
        $this->db->update('sizes', $data, ['size_id' => $id]);
        return $this->db->affected_rows();
    }
}
