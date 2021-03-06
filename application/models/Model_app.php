<?php 
/*
-- ---------------------------------------------------------------
-- MARKETPLACE MULTI BUYER MULTI SELLER + SUPPORT RESELLER SYSTEM
-- CREATED BY : ROBBY PRIHANDAYA
-- COPYRIGHT  : Copyright (c) 2018 - 2019, PHPMU.COM. (https://phpmu.com/)
-- LICENSE    : http://opensource.org/licenses/MIT  MIT License
-- CREATED ON : 2019-03-26
-- UPDATED ON : 2019-03-27
-- ---------------------------------------------------------------
*/
class Model_app extends CI_model{
    public function view($table){
        return $this->db->get($table);
    }

    public function insert($table,$data){
        return $this->db->insert($table, $data);
    }
    public function insert_id($table,$data){
         $this->db->insert($table, $data);
         return $this->db->insert_id();
    }

    public function edit($table, $data){
        return $this->db->get_where($table, $data);
    }
 
    public function update($table, $data, $where){
        return $this->db->update($table, $data, $where); 
    }

    public function delete($table, $where){
        return $this->db->delete($table, $where);
    }

    public function view_where($table,$data){
        $this->db->where($data);
        return $this->db->get($table);
    }

    public function like($table,$data){
        $this->db->like($data);
        return $this->db->get($table);
    }

    public function like_custom($table,$data,$data2){
        $this->db->like($data);
        $this->db->or_like($data2);
        return $this->db->get($table);
    }

    public function view_ordering_limit($table,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }

    public function view_where_ordering_limit($table,$data,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }
    
    public function view_ordering($table,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }   
    public function view_order($table,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }

    public function view_where_ordering($table,$data,$order,$ordering){
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        return $this->db->get($table);
        
    }
    public function view_where_ordering_group($table,$data,$order,$ordering,$group){
        $this->db->where($data);
        $this->db->group_by($group);
        $this->db->order_by($order,$ordering);
    
        return $this->db->get($table);
        
    }

    public function view_join_one($table1,$table2,$field,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_where($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }
    public function join_where($table1,$table2,$field,$where){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
       
        return $this->db->get();
    }
    public function join_where_order($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }
    public function join_where_order2($table1,$table2,$field1,$field2,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }
    public function join_order($table1,$table2,$field,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
     
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }
    public function join_order2($table1,$table2,$field1,$field2,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
     
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }
    public function view_left_join_where($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field,'left');
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    function view_seo($table,$field,$title)
    {
            
            $query = " SELECT * FROM $table WHERE  $field =  '$title' ";
            $query = $this->db->query($query);
            if($query->num_rows() > 0){
                return $title.'_'.rand(4,100);
            }else{
                return $title;
            }
        
    }
    
    function view_seo_updated($table,$field,$title,$fieldId,$id)
    {
            
            $query = " SELECT * FROM $table WHERE  $field =  '$title' AND $fieldId != $id ";
            $query = $this->db->query($query);
            if($query->num_rows() > 0){
                return $title.'_'.rand(4,100);
            }else{
                return $title;
            }
        
    }
    function generateInvoice(){
        $ci = & get_instance();
        $pre = date("ym",time());	
        $query = " SELECT * FROM cr_transaksi WHERE trans_no LIKE '$pre%' ORDER BY trans_no DESC LIMIT 1";
        $query = $ci->db->query($query);
        $rsv_no = "$pre"."0000";
        foreach($query->result() as $row){
            $rsv_no = $row->trans_no;
        }
        $rsv_no = intval($rsv_no) + 1;
        return  $rsv_no;
		
    }
 
}