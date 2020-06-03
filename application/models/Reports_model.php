<?php


class Reports_model extends CI_Model
{
    public function getSupplies()
    {
        return $this->db->get_where('supplies', ['deleted_at' => null])->result_array();
    }

    public function getSupplyMonth()
    {
        $this->db->select('MONTHNAME(supply_date) AS month');
        $this->db->from('supplies');
        $this->db->where('DELETED_AT', null);
        $this->db->group_by('month');

        return $this->db->get()->result_array();
    }

    public function getSupplyYear()
    {
        $this->db->select('YEAR(supply_date) AS year');
        $this->db->from('supplies');
        $this->db->where('DELETED_AT', null);
        $this->db->group_by('year');

        return $this->db->get()->result_array();
    }

    public function getTransactionMonth()
    {
        $this->db->select('MONTHNAME(transaction_date) AS month');
        $this->db->from('transactions');
        $this->db->where('DELETED_AT', null);
        $this->db->group_by('month');

        return $this->db->get()->result_array();
    }

    public function getTransactionYear()
    {
        $this->db->select('YEAR(transaction_date) AS year, MONTHNAME(transaction_date) AS month');
        $this->db->from('transactions');
        $this->db->where('DELETED_AT', null);
        $this->db->group_by('month', 'year');
        $this->db->order_by('year', 'month');

        return $this->db->get()->result_array();
    }

    public function outcomeReport()
    {
        $status = 'Completed';
        $year = '2020';
        $month = 'June';

        $this->db->select('YEAR(po.supply_date) AS TAHUN, MONTHNAME(po.supply_date) AS BULAN, p.product_name AS nama_produk, SUM(dpo.supply_detail_subtotal) AS jumlah_pengeluaran');
        $this->db->from('supply_details dpo');
        $this->db->join('supplies po', 'supply_id');
        $this->db->join('products p', 'product_id');
        $this->db->where('po.supply_status', $status);
        $this->db->where('YEAR(po.supply_date)', $year);
        $this->db->where('MONTHNAME(po.supply_status)', $month);
        $this->db->group_by('dpo.product_id');
        $this->db->order_by('jumlah_pengeluaran', 'DESC');

        return $this->db->get()->result_array();
    }

    public function getMonthlyProducts($year, $month)
    {
        $this->db->select('YEAR(T.transaction_date) AS TAHUN, MONTHNAME(T.transaction_date) AS BULAN, L.product_name AS nama_layanan, SUM(DTL.transaction_product_subtotal) AS jumlah_pendapatan');
        $this->db->from('transaction_product DTL');
        $this->db->join('transactions T', 'transaction_id');
        $this->db->join('products L', 'product_id');
        $this->db->where('T.transaction_status', 'Paid');
        $this->db->where('YEAR(T.transaction_date)', $year);
        $this->db->where('MONTHNAME(T.transaction_date)', $month);
        $this->db->group_by('DTL.product_id');
        $this->db->order_by('jumlah_pendapatan', 'DESC');

        return $this->db->get()->result_array();
    }

    public function getMonthlyServices($year, $month)
    {
        // $tahun = '2020';
        // $bulan = 'June';

        // $this->db->query("SELECT YEAR(T.transaction_date) AS TAHUN, MONTHNAME(T.transaction_date) AS BULAN, L.service_name AS nama_layanan, SUM(DTL.transaction_service_subtotal) AS jumlah_pendapatan
        // FROM transaction_service DTL
        // JOIN transactions T ON (DTL.transaction_id = T.transaction_id)
        // JOIN services L ON (DTL.service_id = L.service_id)
        // WHERE T.transaction_status = 'Paid'
        // AND YEAR(T.transaction_date) = $tahun
        // AND MONTHNAME(T.transaction_date) = $bulan
        // GROUP BY DTL.service_id
        // ORDER BY jumlah_pendapatan DESC");

        // return $this->db->get()->result_array();

        $this->db->select('YEAR(T.transaction_date) AS TAHUN, MONTHNAME(T.transaction_date) AS BULAN, L.service_name AS nama_layanan, SUM(DTL.transaction_service_subtotal) AS jumlah_pendapatan');
        $this->db->from('transaction_service DTL');
        $this->db->join('transactions T', 'transaction_id');
        $this->db->join('services L', 'service_id');
        $this->db->where('T.transaction_status', 'Paid');
        $this->db->where('YEAR(T.transaction_date)', $year);
        $this->db->where('MONTHNAME(T.transaction_date)', $month);
        $this->db->group_by('DTL.service_id');
        $this->db->order_by('jumlah_pendapatan', 'DESC');

        return $this->db->get()->result_array();
    }
}
