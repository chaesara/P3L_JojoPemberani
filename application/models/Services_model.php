<?php


class Services_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getServices($id = null)
    {
        if ($id === null) {
            return $this->db->get('services')->result_array();
        } else {
            return $this->db->get_where('services', ['service_id' => $id])->row_array();
        }
    }

    public function get_by_employee()
    {
        $this->db->select('services.*, employees.employee_name');
        $this->db->join('employees', 'employee_id');
        $this->db->from('services');

        $query = $this->db->get();

        return $query->result_array();
    }

    // Delete - insert now timestamp to deleted_at
    public function deleteServices($id)
    {
        date_default_timezone_set('Asia/Karachi'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        $this->db->update('services', $data, ['service_id' => $id]);
    }

    // Actually delete data from database
    // public function deleteServices($id)
    // {
    //     $this->db->delete('services', ['service_id' => $id]);
    //     return $this->db->affected_rows();
    // }

    public function createServices($data)
    {
        $this->db->insert('services', $data);
        return $this->db->affected_rows();
    }

    public function updateServices($data, $id)
    {
        $this->db->update('services', $data, ['service_id' => $id]);
        return $this->db->affected_rows();
    }

    public function searchServices()
    {
        $keyword = $this->input->post('keyword', true);

        $this->db->select('services.*, employees.employee_name');
        $this->db->join('employees', 'employee_id');
        $this->db->from('services');
        $this->db->like('service_name', $keyword);

        $query = $this->db->get();

        return $query->result_array();

        // $this->db->like('service_name', $keyword);
        // return $this->db->get('services')->result_array();
    }
}
