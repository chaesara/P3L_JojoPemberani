<?php

class Transactions_model extends CI_Model
{
    public function getTransactions($id = null)
    {
        if ($id === null) {
            $this->db->select('transactions.*, e1.employee_name as cs_name, e2.employee_name as cashier_name, customers.customer_name, customers.customer_phoneno');
            $this->db->join('employees as e1', 'e1.employee_id = employee_id_cs');
            $this->db->join('employees as e2', 'e2.employee_id = employee_id_cashier');
            $this->db->join('customers', 'customer_id');
            $this->db->from('transactions');
            $this->db->where('transactions.DELETED_AT', NULL);
            $this->db->order_by('transactions.CREATED_AT', 'DESC');

            return $this->db->get()->result_array();
        } else {
            $this->db->select('transactions.*, e1.employee_name as cs_name, e2.employee_name as cashier_name, customers.customer_name, customers.customer_phoneno');
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
        $this->db->select('transaction_product.*, products.product_name, products.product_price');
        $this->db->join('products', 'product_id');
        $this->db->from('transaction_product');
        $this->db->where('transaction_id', $id);
        $this->db->where('transaction_product.DELETED_AT', NULL);
        $this->db->order_by('transaction_product.CREATED_AT', 'DESC');

        return $this->db->get()->result_array();
    }

    public function getAllServiceDetails($id)
    {
        $this->db->select('transaction_service.*, services.service_name, services.service_price');
        $this->db->join('services', 'service_id');
        $this->db->from('transaction_service');
        $this->db->where('transaction_id', $id);
        $this->db->where('transaction_service.DELETED_AT', NULL);
        $this->db->order_by('transaction_service.CREATED_AT', 'DESC');

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

    public function getServices()
    {
        $this->db->select('services.*, sizes.size_name');
        $this->db->from('services');
        $this->db->join('sizes', 'size_id');
        $this->db->where('services.DELETED_AT', null);

        return $this->db->get()->result_array();
    }

    public function getServiceId($service_name)
    {
        $this->db->select('services.service_id');
        $this->db->from('services');
        $this->db->where('service_name', $service_name);

        $query = $this->db->get();

        return $query->row()->service_id;
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

    public function getAnimals($customer_id)
    {
        $this->db->select('animal_name');
        $this->db->from('animals');
        $this->db->where('customer_id', $customer_id);

        return $this->db->get()->result_array();
    }

    public function getAnimalId($animal_name)
    {
        $this->db->select('animals.animal_id');
        $this->db->from('animals');
        $this->db->where('animal_name', $animal_name);

        $query = $this->db->get();

        return $query->row()->animal_id;
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

    public function updateTransactions($data, $id)
    {
        $this->db->update('transactions', $data, ['transaction_id' => $id]);
        return $this->db->affected_rows();
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

    public function revertProduct($product_id, $updateQty)
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

    public function countSubtotal_pr($product_name, $quantity)
    {
        $this->db->select('products.product_price');
        $this->db->from('products');
        $this->db->where('product_name', $product_name);

        $price = $this->db->get()->row()->product_price;

        return $price * $quantity;
    }

    public function countSubtotal_sr($service_name, $quantity)
    {
        $this->db->select('services.service_price');
        $this->db->from('services');
        $this->db->where('service_name', $service_name);

        $price = $this->db->get()->row()->service_price;

        return $price * $quantity;
    }

    public function countTransactionSubTotal_pr($id)
    {
        $subtotal = 0;

        $details = $this->transactions_model->getAllProductDetails($id);

        foreach ($details as $d) {
            $subtotal += $d['transaction_product_subtotal'];
        };

        $data = [
            'transaction_subtotal' => $subtotal
        ];
        $this->db->update('transactions', $data, ['transaction_id' => $id]);
    }

    public function countTransactionSubTotal_sr($id)
    {
        $subtotal = 0;

        $details = $this->transactions_model->getAllServiceDetails($id);

        foreach ($details as $d) {
            $subtotal += $d['transaction_service_subtotal'];
        };

        $data = [
            'transaction_subtotal' => $subtotal
        ];
        $this->db->update('transactions', $data, ['transaction_id' => $id]);
    }

    public function countTotal($id)
    {
        $subtotal = $this->db->get_where('transactions', ['transaction_id' => $id])->row()->transaction_subtotal;
        $discount = $this->db->get_where('transactions', ['transaction_id' => $id])->row()->transaction_discount;
        $total = $subtotal - $discount;
        $data = [
            'transaction_total' => $total
        ];
        $this->db->update('transactions', $data, ['transaction_id' => $id]);
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
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');

        $status = [
            'transaction_status' => 'Paid',
            'transaction_date' => $now,
            'employee_id_cashier' => $this->session->userdata('employee_id')
        ];

        return $this->db->update('transactions', $status, ['transaction_id' => $id]);
    }
}
