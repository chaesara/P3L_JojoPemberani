<?php


class Customers_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCustomers($id = null)
    {
        if ($id === null) {
            return $this->db->get('customers')->result_array();
        } else {
            return $this->db->get_where('customers', ['customer_id' => $id])->result_array();
        }
    }

    public function get_by_employee()
    {
        $this->db->select('customers.*, employees.employee_name');
        $this->db->join('employees', 'employee_id');
        $this->db->from('customers');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function deleteCustomers($id)
    {
        $this->db->delete('customers', ['customer_id' => $id]);
        return $this->db->affected_rows();
    }

    public function createCustomers($data)
    {
        $this->db->insert('customers', $data);
        return $this->db->affected_rows();
    }

    public function updateCustomers($data, $id)
    {
        $this->db->update('customers', $data, ['customer_id' => $id]);
        return $this->db->affected_rows();
    }

    public function searchCustomers()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('customer_name', $keyword);
        return $this->db->get('customers')->result_array();
    }
}
