<?php

class Masterview2 extends Mastermodel2{

    public function userlogin($table, $token, $usertoken){
       return $this->user_login($table, $token, $usertoken);
    }

    
    public function search($table, $column1, $column2, $column3, $column4, $Something){
        return $this->find_something($table, $column1, $column2, $column3, $column4, $Something);
    }

    public function search_result($table, $column1, $column2, $column3, $column4, $Something){
        return $this->searchresult($table, $column1, $column2, $column3, $column4, $Something);
    }

    public function catch_user_stu($table, $id, $limit, $userid, $sessionid){
        return $this->catch($table, $id, $limit, $userid, $sessionid);
    }

    public function row_fetching_with_and_operator($table, $pid, $pidval, $uId, $uidVal){
        return $this->fetch_row_with_and_op($table, $pid, $pidval, $uId, $uidVal);
    }

    public function fetch_with_double_condtioning($datatable, $pid, $pidValue, $uid, $uidValue){
        return $this->select_with_and_operator($datatable, $pid, $pidValue, $uid, $uidValue);
    }

    public function select__between(string $table, string $keyrow, int $firstkey, int $lastkey){
        return $this->select__with__limit($table, $keyrow, $firstkey, $lastkey);
    }

    public function fetch_row_fastly(string $table,string $wht_count){
        return $this->fetch_row_without_condition($table, $wht_count);
    }

    public function grid__pagination_query(string $table, string $what, int $limit, int $offsetValue){
        return $this->query__for_pagination($table, $what, $limit, $offsetValue);
    }

}

?>