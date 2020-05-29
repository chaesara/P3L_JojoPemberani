<?php

class Transactions_model extends CI_Model
{
    public function getTransactions($id = null)
    {
        if ($id === null) {
            $this->db->select('transactions.*, e1.employee_name as cs_name, e2.employee_name as cashier_name, customers.customer_name');
            $this->db->join('employees as e1', 'e1.employee_id = employee_id_cs');
            $this->db->join('employees as e2', 'e2.employee_id = employee_id_cashier');
            $this->db->join('customers', 'customer_id');
            $this->db->from('transactions');
            $this->db->where('transactions.DELETED_AT', NULL);

            return $this->db->get()->result_array();
        } else {
            $this->db->select('transactions.*, e1.employee_name as cs_name, e2.employee_name as cashier_name, customers.customer_name');
            $this->db->join('employees as e1', 'e1.employee_id = employee_id_cs');
            $this->db->join('employees as e2', 'e2.employee_id = employee_id_cashier');
            $this->db->join('customers', 'customer_id');
            $this->db->from('transactions');
            $this->db->where('transactions.transaction_id', $id);

            return $this->db->get()->row_array();
        }
    }

    public function getAllProductDetails($id)
    {
        $this->db->select('transaction_product.*, products.product_name');
        $this->db->join('products', 'product_id');
        $this->db->from('transaction_product');
        $this->db->where('transaction_id', $id);
        $this->db->where('transaction_product.DELETED_AT', NULL);

        return $this->db->get()->result_array();
    }

    public function getAllServiceDetails($id)
    {
        $this->db->select('transaction_service.*, services.service_name');
        $this->db->join('services', 'service_id');
        $this->db->from('transaction_service');
        $this->db->where('transaction_id', $id);
        $this->db->where('transaction_service.DELETED_AT', NULL);

        return $this->db->get()->result_array();
    }

    public function getProductDetails($id)
    {
        $this->db->select('transaction_product.*, products.product_name');
        $this->db->join('products', 'product_id');
        $this->db->from('transaction_product');
        $this->db->where('transaction_product_id', $id);

        return $this->db->get()->row_array();
    }

    public function getServiceDetails($id)
    {
        $this->db->select('transaction_service.*, services.service_name');
        $this->db->join('services', 'service_id');
        $this->db->from('transaction_service');
        $this->db->where('transaction_service_id', $id);

        return $this->db->get()->row_array();
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

    public function getCustomers()
    {
        return $this->db->get_where('customers', ['deleted_at' => null])->result_array();
    }

    public function getCustomerId($customer_name)
    {
        $this->db->select('customers.customer_id');
        $this->db->from('customers');
        $this->db->where('customer_name', $customer_name);

        $query = $this->db->get();

        return $query->row()->customer_id;
    }

    public function createProductTransactions($data)
    {
        $this->db->insert('transactions', $data);
        $this->db->affected_rows();

        $id = $this->db->get_where('transactions', ['transaction_code' => null])->row()->transaction_id;

        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $code = 'PR' . '-' . date('Y-m-d') . '-' . $id;

        $data = [
            'transaction_code' => $code
        ];
        $this->db->update('transactions', $data, ['transaction_code' => null]);
        $this->db->affected_rows();

        return $id;
    }

    public function createServiceTransactions($data)
    {
        $this->db->insert('transactions', $data);
        $this->db->affected_rows();

        $id = $this->db->get_where('transactions', ['transaction_code' => null])->row()->transaction_id;

        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $code = 'LY' . '-' . date('Y-m-d') . '-' . $id;

        $data = [
            'transaction_code' => $code
        ];
        $this->db->update('transactions', $data, ['transaction_code' => null]);
        $this->db->affected_rows();

        return $id;
    }

    public function deleteProductTransactions($id)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        $this->db->update('transaction_product', $data, ['transaction_id' => $id]);

        $data = [
            'transaction_status' => 'Canceled',
            'DELETED_AT' => $now
        ];
        return $this->db->update('transactions', $data, ['transaction_id' => $id]);
    }

    public function deleteServiceTransactions($id)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        $this->db->update('transaction_service', $data, ['transaction_id' => $id]);

        $data = [
            'transaction_status' => 'Canceled',
            'DELETED_AT' => $now
        ];
        return $this->db->update('transactions', $data, ['transaction_id' => $id]);
    }

    public function deleteProductDetails($id)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        return $this->db->update('transaction_product', $data, ['transaction_product_id' => $id]);
    }

    public function deleteServiceDetails($id)
    {
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $data = [
            'DELETED_AT' => $now
        ];
        return $this->db->update('transaction_service', $data, ['transaction_service_id' => $id]);
    }

    public function createProductDetails($data)
    {
        
        $this->db->insert('transaction_product', $data);
        return $this->db->affected_rows();
    }

    public function createServiceDetails($data)
    {
        $this->db->insert('transaction_service', $data);
        return $this->db->affected_rows();
    }

    public function updateProductDetails($data, $id)
    {
        $this->db->update('transaction_product', $data, ['transaction_product_id' => $id]);
        return $this->db->affected_rows();
    }

    public function updateServiceDetails($data, $id)
    {
        $this->db->update('transaction_service', $data, ['transaction_service_id' => $id]);
        return $this->db->affected_rows();
    }

    public function updateProduct($product_id, $updateQty)
    {
        $this->db->select('products.product_quantity');
        $this->db->from('products');
        $this->db->where('product_id', $product_id);

        $p_qty = $this->db->get()->row()->product_quantity;

        $qty = [
            'product_quantity' => $p_qty - $updateQty
        ];

        return $this->db->update('products', $qty, ['product_id' => $product_id]);
    }

    public function countSubtotal($product_name, $quantity)
    {
        $this->db->select('products.product_price');
        $this->db->from('products');
        $this->db->where('product_name', $product_name);

        $price = $this->db->get()->row()->product_price;

        return $price * $quantity;
    }

    public function proceedTransaction($id)
    {
        $status = [
            'transaction_status' => 'Not Yet'
        ];

        return $this->db->update('transactions', $status, ['transaction_id' => $id]);
    }

    public function proceedPayment($id)
    {
        $status = [
            'transaction_status' => 'Paid'
        ];

        return $this->db->update('transactions', $status, ['transaction_id' => $id]);
    }
}
