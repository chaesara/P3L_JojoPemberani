<?php


class Animals_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAnimals($id = null)
    {
        if ($id === null) {
            return $this->db->get('animals')->result_array();
        } else {
            return $this->db->get_where('animals', ['animal_id' => $id])->row_array();
        }
    }

    public function get_by_employee()
    {
        $this->db->select('animals.*, employees.employee_name, animal_types.type_name, customers.customer_name');
        $this->db->join('employees', 'employee_id');
        $this->db->join('customers', 'customer_id');
        $this->db->join('animal_types', 'type_id');
        $this->db->from('animals');
        $this->db->where('animals.DELETED_AT', NULL);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getCustomers()
    {
        return $this->db->get_where('customers', ['deleted_at'=> null])->result_array();
    }

    public function getCustomerId($customer_name)
    {
        $this->db->select('customers.customer_id');
        $this->db->from('customers');
        $this->db->where('customer_name', $customer_name);

        $query = $this->db->get();

        return $query->row()->customer_id;
    }

    public function getTypes()
    {
        return $this->db->get_where('animal_types', ['deleted_at'=> null])->result_array();
    }

    public function getTypeId($type_name)
    {
        $this->db->select('animal_types.type_id');
        $this->db->from('animal_types');
        $this->db->where('type_name', $type_name);

        $query = $this->db->get();

        return $query->row()->type_id;
    }

    // Delete - insert now timestamp to deleted_at
    public function deleteAnimals($id)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        return $this->db->update('animals', $data, ['animal_id' => $id]);
    }

    // Actually delete data from database
    // public function deleteAnimals($id)
    // {
    //     $this->db->delete('animals', ['animal_id' => $id]);
    //     return $this->db->affected_rows();
    // }

    public function createAnimals($data)
    {
        $this->db->insert('animals', $data);
        return $this->db->affected_rows();
    }

    public function updateAnimals($data, $id)
    {
        $this->db->update('animals', $data, ['animal_id' => $id]);
        return $this->db->affected_rows();
    }

    public function searchAnimals()
    {
        $keyword = $this->input->post('keyword', true);

        $this->db->select('animals.*, employees.employee_name');
        $this->db->join('employees', 'employee_id');
        $this->db->from('animals');
        $this->db->like('animal_name', $keyword);

        $query = $this->db->get();

        return $query->result_array();

        // $this->db->like('service_name', $keyword);
        // return $this->db->get('services')->result_array();
    }
}
