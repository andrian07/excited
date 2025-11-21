<?php

class masterdata_model extends CI_Model {

    //member
    public function customer_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_customer');
        if($search != null){
            $this->db->where('customer_code like "%'.$search.'%"');
            $this->db->or_where('customer_name like "%'.$search.'%"');
            $this->db->or_where('customer_phone like "%'.$search.'%"');
        }
        $this->db->where('customer_active', 'Y');
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function customer_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_customer');
        if($search != null){
            $this->db->where('customer_code like "%'.$search.'%"');
            $this->db->or_where('customer_name like "%'.$search.'%"');
            $this->db->or_where('customer_phone like "%'.$search.'%"');
        }
        $this->db->where('customer_active', 'Y');
        $query = $this->db->get();
        return $query;
    }

    public function delete_customer($customer_id)
    {
        $this->db->set('is_active', 'N');
        $this->db->where('customer_id ', $customer_id);
        $this->db->update('ms_customer');
    }

    public function edit_customer($data_update, $customer_id)
    {
        $this->db->set($data_update);
        $this->db->where('customer_id', $customer_id);
        $this->db->update('ms_customer');
    }
    
    public function save_customer($data_insert)
    {
        $this->db->trans_start();
        $this->db->insert('ms_customer', $data_insert);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function last_customer_code()
    {
        $query = $this->db->query("select customer_code from ms_customer order by customer_id desc limit 1");
        $result = $query->result();
        return $result;
    }
    
    //end member

    //product
    public function product_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_product');
        if($search != null){
            $this->db->where('product_code like "%'.$search.'%"');
            $this->db->or_where('product_name like "%'.$search.'%"');
        }
        $this->db->where('product_active', 'Y');
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function product_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_product');
        if($search != null){
            $this->db->where('product_code like "%'.$search.'%"');
            $this->db->or_where('product_name like "%'.$search.'%"');
        }
        $this->db->where('product_active', 'Y');
        $query = $this->db->get();
        return $query;
    }

  
    //end member

    
}

?>