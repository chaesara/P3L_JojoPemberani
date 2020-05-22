<?php


class Supplies_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_employee($id = null)
    {
        if ($id === null) {
            $this->db->select('supplies.*, employees.employee_name, suppliers.supplier_name, suppliers.supplier_address, suppliers.supplier_phoneno');
            $this->db->join('employees', 'employee_id');
            $this->db->join('suppliers', 'supplier_id');
            $this->db->from('supplies');
            $this->db->where('supplies.DELETED_AT', NULL);

            return $this->db->get()->result_array();
        } else {
            $this->db->select('supplies.*, employees.employee_name, suppliers.supplier_name, suppliers.supplier_address, suppliers.supplier_phoneno');
            $this->db->join('employees', 'employee_id');
            $this->db->join('suppliers', 'supplier_id');
            $this->db->from('supplies');
            $this->db->where('supplies.supply_id', $id);

            return $this->db->get()->row_array();
        }
    }

    public function getAllDetails($id)
    {
        $this->db->select('supply_details.*, products.product_name');
        $this->db->join('products', 'product_id');
        $this->db->from('supply_details');
        $this->db->where('supply_id', $id);
        $this->db->where('supply_details.DELETED_AT', NULL);

        return $this->db->get()->result_array();
    }

    public function getDetails($id)
    {
        $this->db->select('supply_details.*, products.product_name');
        $this->db->join('products', 'product_id');
        $this->db->from('supply_details');
        $this->db->where('supply_detail_id', $id);

        return $this->db->get()->row_array();
    }

    public function createSupplies($data)
    {
        $this->db->insert('supplies', $data);
        $this->db->affected_rows();

        $id = $this->db->get_where('supplies', ['supply_code' => null])->row()->supply_id;

        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $code = 'PO' . '-' . date('Y-m-d') . '-' . $id;

        $data = [
            'supply_code' => $code
        ];
        $this->db->update('supplies', $data, ['supply_code' => null]);
        return $this->db->affected_rows();
    }

    public function deleteSupplies($id)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        $this->db->update('supply_details', $data, ['supply_id' => $id]);

        $data = [
            'supply_status' => 'Canceled',
            'DELETED_AT' => $now
        ];
        return $this->db->update('supplies', $data, ['supply_id' => $id]);
    }

    public function deleteDetails($id)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        return $this->db->update('supply_details', $data, ['supply_detail_id' => $id]);
    }

    public function createDetails($data)
    {
        $this->db->insert('supply_details', $data);
        return $this->db->affected_rows();
    }

    public function updateDetails($data, $id)
    {
        $this->db->update('supply_details', $data, ['supply_detail_id' => $id]);
        return $this->db->affected_rows();
    }

    public function countSubtotal($product_name, $quantity)
    {
        $this->db->select('products.product_price');
        $this->db->from('products');
        $this->db->where('product_name', $product_name);

        $price = $this->db->get()->row()->product_price;

        return $price * $quantity;
    }

    public function getSuppliers()
    {
        return $this->db->get_where('suppliers', ['deleted_at' => null])->result_array();
    }

    public function getSupplierId($supplier_name)
    {
        $this->db->select('suppliers.supplier_id');
        $this->db->from('suppliers');
        $this->db->where('supplier_name', $supplier_name);

        $query = $this->db->get();

        return $query->row()->supplier_id;
    }

    public function getProducts()
    {
        return $this->db->get_where('products', ['deleted_at' => null])->result_array();
    }

    public function getProductId($product_name)
    {
        $this->db->select('products.product_id');
        $this->db->from('products');
        $this->db->where('product_name', $product_name);

        $query = $this->db->get();

        return $query->row()->product_id;
    }

    public function updateProduct($product_id, $updateQty)
    {
        $this->db->select('products.product_quantity');
        $this->db->from('products');
        $this->db->where('product_id', $product_id);

        $p_qty = $this->db->get()->row()->product_quantity;

        $qty = [
            'product_quantity' => $p_qty + $updateQty
        ];

        return $this->db->update('products', $qty, ['product_id' => $product_id]);
    }

    public function sendSupplies($id)
    {
        $status = [
            'supply_status' => 'Completed'
        ];

        return $this->db->update('supplies', $status, ['supply_id' => $id]);
    }
}
