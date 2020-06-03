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

        return $this->db->get()->result();
    }
}
