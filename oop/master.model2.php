<?php

class Mastermodel2 extends Database{

        //This private method is used for user Sign up for this gridweb app
        protected function user_signup($first_name, $last_name, $User_Gender, $user_name, $user_password, $secuirty_token){

            $adding_users = "INSERT INTO users (First_Name, Last_name, User_Gender, User_Namee, User_Password, security_token)
            VALUE (?,?,?,?,?,?)";
            $firing_this_query = $this->connect()->prepare($adding_users);
            $firing_this_query->execute([$first_name, $last_name, $User_Gender, $user_name, $user_password, $secuirty_token]);

        }

        //This method will be used to create login system for his gridweb app
        
        protected function user_login($table, $token, $usertoken){
            $selecting_the_user = "SELECT count(*) FROM $table WHERE $token='$usertoken'";
             $firing_selecting_the_user = $this->connect()->prepare($selecting_the_user);
             $firing_selecting_the_user->execute();
             return $firing_selecting_the_user->fetchColumn();

        }

        //this method is for search engine of the gridweb
        protected function find_something($table, $column1, $column2, $column3, $column4, $Something){
            $find_query = "SELECT * FROM $table WHERE $column1 LIKE '%$Something%' OR $column2 LIKE '%$Something%'
             OR $column3 LIKE '%$Something%' OR $column4 LIKE '%$Something%'";
            $firing_find_query = $this->connect()->prepare($find_query);
            $firing_find_query->execute();
            return $firing_find_query->fetchAll();
        }

        //this method is used for the search results of the gridweb
        protected function searchresult($table, $column1, $column2, $column3, $column4, $Something){
            $finding_something = "SELECT count(*) FROM $table WHERE $column1 LIKE '%$Something%' OR $column2 LIKE '%$Something%'
            OR $column3 LIKE '%$Something%' OR $column4 LIKE '%$Something%'";
            $run_finding_something = $this->connect()->prepare($finding_something);
            $run_finding_something->execute();
            return $run_finding_something->fetchColumn();
        }

        protected function user_profile($table, $column, $key){
            $sql = "INSERT INTO $table ($column) VALUES ($key)";
            $fire_sql = $this->connect()->prepare($sql);
            $fire_sql->execute();
        }

        protected function upload_profile_and_cover(int $keyvalue, string $filevalue, string $table, string $user_key, string $filedata){
            $pro_and_cov_sql = "INSERT INTO $table ($user_key, $filedata) VALUES (?, ?)";
            $firing_pro_and_cov_sql = $this->connect()->prepare($pro_and_cov_sql);
            $firing_pro_and_cov_sql->execute([$keyvalue, $filevalue]);
        }
        
        protected function update_pp_cv($table, $column1, $columnvalue, $key, $keyval){
            $up_pp_cv_query = "UPDATE $table SET $column1='$columnvalue' WHERE $key=$keyval";
            $firing_up_pp_cv_query = $this->connect()->prepare($up_pp_cv_query);
            $firing_up_pp_cv_query->execute();
        }

        protected function catch($table, $id, $limit, $userid, $sessionid){
            $sql_for_blog = "SELECT * FROM $table ORDER BY $id ASC LIMIT $limit WHERE $userid=$sessionid";
            $firing_sql_for_blog = $this->connect()->prepare($sql_for_blog);
            $firing_sql_for_blog->execute();
            return $firing_sql_for_blog->fetchAll();
   
        }

        protected function fetch_row_with_and_op($table, $pid, $pidval, $uId, $uidVal){
            $sql = "SELECT count(*) FROM $table WHERE $pid='$pidval' AND $uId='$uidVal'";
            $sql_fire = $this->connect()->prepare($sql);
            $sql_fire->execute();
            return $sql_fire->fetchColumn();
        }



        protected function insert_that_cant_be_inject(int $fclval, int $sclval, string $tclval){
            $sql = "INSERT INTO reaction (post_id, user_id, rection_type) VALUES (?, ?, ?)";
            $fire_sql = $this->connect()->prepare($sql);
            $fire_sql->execute([$fclval, $sclval, $tclval]);
        }

        protected function select_with_and_operator($datatable, $pid, $pidValue, $uid, $uidValue){
            $sql = "SELECT * FROM $datatable WHERE $pid='$pidValue' AND $uid='$uidValue'";
            $fire_this_query = $this->connect()->prepare($sql);
            $fire_this_query->execute();
            return $fire_this_query->fetchAll();
        }

        protected function delete_with_and($table, $cl1, $cl1val, $cl2, $cl2val){
            $sql = "DELETE FROM $table WHERE $cl1='$cl1val' AND $cl2='$cl2val'";
            $fire = $this->connect()->prepare($sql);
            $fire->execute();
        }


        protected function update_with_and($table, $column, $columnvalue, $cond1, $cond1val, $cond2, $cond2val){
            $sql = "UPDATE $table SET $column='$columnvalue' WHERE $cond1='$cond1val' AND $cond2='$cond2val'";
            $stmt_sql = $this->connect()->prepare($sql);
            $stmt_sql->execute();
        }


        protected function select__with__limit(string $table, string $keyrow, int $firstkey, int $lastkey){
            $sql = "SELECT * FROM $table WHERE $keyrow BETWEEN $firstkey AND $lastkey";
            $fire_sql = $this->connect()->prepare($sql);
            $fire_sql->execute();
            return $fire_sql->fetchAll();
        }

        protected function fetch_row_without_condition(string $table, string $wht_count){
            $sql = "SELECT COUNT($wht_count) FROM $table";
            $sql_fire = $this->connect()->prepare($sql);
            $sql_fire->execute();
            return $sql_fire->fetchColumn();
        }


        protected function query__for_pagination(string $table, string $what, int $limit, int $offsetValue){
            $sql = "SELECT * FROM $table ORDER BY $what DESC LIMIT $limit OFFSET $offsetValue";
            $sql_fire = $this->connect()->prepare($sql);
            $sql_fire->execute();
            return $sql_fire->fetchAll();
        }

        protected function update__category__description(string $description, int $id, string $table, 
         string $column){
            $sql = "UPDATE $table SET $column=? WHERE id=?";
            $sql__fire = $this->connect()->prepare($sql);
            $sql__fire->execute([$description, $id]);
        }


        protected function update__admin__bio(string $bio, int $id){
            $sql = "UPDATE users_profile SET bio=? WHERE user_id=?";
            $sql_firing = $this->connect()->prepare($sql);
            $sql_firing->execute([$bio, $id]);
        }



}

?>