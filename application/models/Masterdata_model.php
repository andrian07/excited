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

    public function get_member_by_id($id)
    {
        $query = $this->db->query("select * from ms_member where member_id='".$id."'");
        $result = $query->result();
        return $result;
    }


    public function delete_member($member_id)
    {
        $this->db->set('is_active', 'N');
        $this->db->where('member_id ', $member_id);
        $this->db->update('ms_member');
    }

    public function edit_member($data_edit, $member_id)
    {
        $this->db->set($data_edit);
        $this->db->where('member_id', $member_id);
        $this->db->update('ms_member');
    }
    
    public function save_member($data_insert)
    {
        $this->db->trans_start();
        $this->db->insert('ms_member', $data_insert);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function last_member_code()
    {
        $query = $this->db->query("select member_code from ms_member order by member_id desc limit 1");
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