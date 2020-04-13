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

    public function deleteProducts($id)
    {
        $query = $this->db->select('img')->from('products')->where('product_id', $id)->get();
        $img = $query->row()->img;

<<<<<<< HEAD
        $pathfile = './assets/products/' . $img;
=======
        $pathfile = './assets/products/'.$img;
>>>>>>> f66337224039f599c8cff1c0e4efc1f2a5571c56
        unlink($pathfile);
        $this->db->delete('products', ['product_id' => $id]);
        return $this->db->affected_rows();
    }

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
