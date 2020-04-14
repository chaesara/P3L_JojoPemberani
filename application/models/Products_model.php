<?php


class Products_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProducts($id = null)
    {
        if ($id === null) {
            return $this->db->get('products')->result_array();
        } else {
            return $this->db->get_where('products', ['product_id' => $id])->row_array();
        }
    }

    public function get_by_employee()
    {
        $this->db->select('products.*, employees.employee_name');
        $this->db->join('employees', 'employee_id');
        $this->db->from('products');

        $query = $this->db->get();

        return $query->result_array();
    }

    // Delete - insert now timestamp to deleted_at
    public function deleteProducts($id)
    {
        $query = $this->db->select('img')->from('products')->where('product_id', $id)->get();
        $img = $query->row()->img;

        $pathfile = './assets/products/' . $img;
        unlink($pathfile);

        date_default_timezone_set('Asia/Karachi'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now,
            'img' => null
        ];
        $this->db->update('products', $data, ['product_id' => $id]);
    }

    // Actually delete data from database
    // public function deleteProducts($id)
    // {
    //     $query = $this->db->select('img')->from('products')->where('product_id', $id)->get();
    //     $img = $query->row()->img;

    //     $pathfile = './assets/products/' . $img;
    //     unlink($pathfile);
    //     $this->db->delete('products', ['product_id' => $id]);
    //     return $this->db->affected_rows();
    // }

    public function createProducts($data)
    {
        $this->db->insert('products', $data);
        return $this->db->affected_rows();
    }

    public function updateProducts($data, $id)
    {
        $query = $this->db->select('img')->from('products')->where('product_id', $id)->get();
        $img = $query->row()->img;

        if ($data['img'] != NULL) {
            $pathfile = './assets/products/' . $img;
            unlink($pathfile);
        } else {
            $data['img'] = $img;
        }

        // delete img file -> then upload the new one

        $this->db->update('products', $data, ['product_id' => $id]);
        return $this->db->affected_rows();
    }

    public function searchProducts()
    {
        $keyword = $this->input->post('keyword', true);

        $this->db->select('products.*, employees.employee_name');
        $this->db->join('employees', 'employee_id');
        $this->db->from('products');
        $this->db->like('product_name', $keyword);

        $query = $this->db->get();

        return $query->result_array();


        // $this->db->like('product_name', $keyword);
        // return $this->db->get('products')->result_array();
    }
}
