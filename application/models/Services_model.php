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

    public function getSizes()
    {
        return $this->db->get_where('sizes', ['deleted_at'=> null])->result_array();
    }

    public function getSizeId($size_name)
    {
        $this->db->select('sizes.size_id');
        $this->db->from('sizes');
        $this->db->where('size_name', $size_name);

        $query = $this->db->get();

        return $query->row()->size_id;
    }

    public function get_by_employee()
    {
        $this->db->select('services.*, employees.employee_name, sizes.size_name');
        $this->db->join('employees', 'employee_id');
        $this->db->join('sizes', 'size_id');
        $this->db->from('services');
        $this->db->where('services.DELETED_AT', NULL);
        $this->db->order_by('services.CREATED_AT', 'DESC');

        $query = $this->db->get();

        return $query->result_array();
    }

    // Delete - insert now timestamp to deleted_at
    public function deleteServices($id)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        return $this->db->update('services', $data, ['service_id' => $id]);
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
