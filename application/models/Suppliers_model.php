<?php


class Suppliers_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getSuppliers($id = null)
    {
        if ($id === null) {
            return $this->db->get('suppliers')->result_array();
        } else {
            return $this->db->get_where('suppliers', ['supplier_id' => $id])->row_array();
        }
    }

    public function get_by_employee()
    {
        $this->db->select('suppliers.*, employees.employee_name');
        $this->db->join('employees', 'employee_id');
        $this->db->from('suppliers');

        $query = $this->db->get();

        return $query->result_array();
    }

    // Delete - insert now timestamp to deleted_at
    public function deleteSuppliers($id)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        return $this->db->update('suppliers', $data, ['supplier_id' => $id]);
    }

    // Actually delete data from database
    // public function deleteSuppliers($id)
    // {
    //     $this->db->delete('suppliers', ['supplier_id' => $id]);
    //     return $this->db->affected_rows();
    // }

    public function createSuppliers($data)
    {
        $this->db->insert('suppliers', $data);
        return $this->db->affected_rows();
    }

    public function updateSuppliers($data, $id)
    {
        $this->db->update('suppliers', $data, ['supplier_id' => $id]);
        return $this->db->affected_rows();
    }
}
