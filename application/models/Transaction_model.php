<?php

class transaction_model extends CI_Model {

    public function transaction_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('transaction_header');
        $this->db->join('ms_customer', 'transaction_header.transaction_header_customer_id = ms_customer.customer_id');
        if($search != null){
            $this->db->where('transaction_header_invoice like "%'.$search.'%"');
            $this->db->or_where('customer_name like "%'.$search.'%"');
        }
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function transaction_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('transaction_header');
        $this->db->join('ms_customer', 'transaction_header.transaction_header_customer_id = ms_customer.customer_id');
        if($search != null){
            $this->db->where('transaction_header_invoice like "%'.$search.'%"');
            $this->db->or_where('customer_name like "%'.$search.'%"');
        }
        $query = $this->db->get();
        return $query;
    }


    public function temp_sales_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('temp_transaction');
        $this->db->join('ms_product', 'temp_transaction.temp_product_id = ms_product.product_id');
        if($search != null){
            $this->db->or_where('product_name like "%'.$search.'%"');
        }
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function temp_sales_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('temp_transaction');
        $this->db->join('ms_product', 'temp_transaction.temp_product_id = ms_product.product_id');
        if($search != null){
            $this->db->or_where('product_name like "%'.$search.'%"');
        }
        $query = $this->db->get();
        return $query;
    }
}

?>