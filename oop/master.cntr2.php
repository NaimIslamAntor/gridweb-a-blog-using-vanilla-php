<?php
class Mastercntr2 extends Mastermodel2{

    
    //this method for controlling registration
    public function signup($first_name, $last_name, $User_Gender, $user_name, $user_password, $secuirty_token){
        $this->user_signup($first_name, $last_name, $User_Gender, $user_name, $user_password, $secuirty_token);
    }

    public function profile($table, $column, $key){
        $this->user_profile($table, $column, $key);
    }

    public function uploading(int $keyvalue, string $filevalue, string $table, string $user_key, string $filedata){
        $this->upload_profile_and_cover($keyvalue, $filevalue, $table, $user_key, $filedata);
    }

   
    public function upadte_pp_and_cv($table, $column1, $columnvalue, $key, $keyval){
        $this->update_pp_cv($table, $column1, $columnvalue, $key, $keyval);
    }

    public function insert_that_cant_be_injected(int $fclval, int $sclval, string $tclval){
        $this->insert_that_cant_be_inject($fclval, $sclval, $tclval);
    }


    public function delete_with_and_op($table, $cl1, $cl1val, $cl2, $cl2val){
        $this->delete_with_and($table, $cl1, $cl1val, $cl2, $cl2val);
    }

    public function update_with_and_op($table, $column, $columnvalue, $cond1, $cond1val, $cond2, $cond2val){
        $this->update_with_and($table, $column, $columnvalue, $cond1, $cond1val, $cond2, $cond2val);
    }

    public function update__more__safely(string $description, int $id, string $table, 
    string $column){
        $this->update__category__description($description, $id, $table, $column);
    }

    public function update__bio(string $bio, int $id){
        $this->update__admin__bio($bio, $id);
    }

}

class StuffCntr extends someStuffModel{

    public function let_me_update(string $col1val, string $col2val,
    string $col3val, string $col4val, string $col5val, int $keyVal){
        $this->update($col1val,  $col2val,
        $col3val, $col4val, $col5val,  $keyVal);
    }

    public function let_me_upload(int $author, string $col1val, string $col2val,
    string $col3val, string $col4val, string $col5val,string $col6val){

        $this->upload($author, $col1val, $col2val,
        $col3val, $col4val, $col5val, $col6val);
    }
}

?>