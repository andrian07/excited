<?php

class global_model extends CI_Model {

    public function save($data_insert_act)
    {
        $this->db->insert('activity_table', $data_insert_act);
    }

    public function check_access($user_role_id, $modul){
        $query = $this->db->query("select * from ms_role a, ms_role_permision b, ms_module c where a.role_id = b.role_id and b.module_id = c.module_id and a.role_id = '".$user_role_id."' and module_name = '".$modul."';");
        $result = $query->result();
        return $result;
    }

    public function customer_list(){
        $query = $this->db->query("select * from ms_customer where customer_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function ekspedisi_list(){
        $query = $this->db->query("select * from ms_ekspedisi where ms_ekspedisi_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function get_customer($customer_id)
    {
        $query = $this->db->query("select * from ms_customer where customer_id = '".$customer_id."'");
        $result = $query->result();
        return $result;
    }

    public function search_product($keyword)
    {
        $this->db->select('*');
        $this->db->from('ms_product');
        $this->db->where('product_active', 'y');
        if($keyword != null){
            $this->db->where('product_name like "%'.$keyword.'%"');
        }
        $this->db->limit(50);
        $query = $this->db->get();
        return $query;
    }
}

?>