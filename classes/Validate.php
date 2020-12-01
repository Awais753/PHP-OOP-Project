<?php
class Validate{
    public static function userName($name){
        
            $exists = false;
            $username = $name;
            $db = Database::getInstance();
            $rows = $db->get("users",array('username', '=', $username));
            
            if(!$rows->error()){
                if ($db->count()) {
                   $exists = true;
                }
            }
           
            return $exists;
        
    }

    public static function book($title){
        
        $exists = false;
        $title = $title;
        $db = Database::getInstance();
        $rows = $db->get("books",array('title', '=', $title));
        
        if(!$rows->error()){
            if ($db->count()) {
               $exists = true;
            }
        }
       
        return $exists;
    
    }

    public static function adminName($name){
        
        $exists = false;
        $username = $name;
        $db = Database::getInstance();
        $rows = $db->get("librerian",array('username', '=', $username));
        
        if(!$rows->error()){
            if ($db->count()) {
               $exists = true;
            }
        }
       
        return $exists;
    
    }

    public static function adminPass($pass){
        
        $exists = false;
       
        $db = Database::getInstance();
        $rows = $db->get("librerian",array('password', '=', $pass));
        
        if(!$rows->error()){
            if ($db->count()) {
               $exists = true;
            }
        }
       
        return $exists;
    
}   

    public static function email($email){
        $exists = false;
        $db = Database::getInstance();
        $rows = $db->get("users",array('username', '=', $email));
        
        if(!$rows->error()){
            if ($db->count()) {
               $exists = true;
            }
        }
       
        return $exists;
    }

    public static function password($password){
        $exists = false;
        $db = Database::getInstance();
        $rows = $db->get("users",array('password', '=', $password));
        
        if(!$rows->error()){
            if ($db->count()) {
               $exists = true;
            }
        }
       
        return $exists;
    }
    
    public static function flash($class,$message){
       return "<div class='alert alert-".$class." alert-dismissible'>".$message."</div>"  ;
    }

}
?>