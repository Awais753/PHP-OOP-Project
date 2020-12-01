<?php
class Librerian{
    private static $_instance;
    private $_db;
    private $_data;
    private $_sessionName;
    private $_LoggedIn = false;

    private function __construct(){
        $this->_db = Database::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_data = $this->_db->get("librerian",array('username', '=', 'admin'))->results()[0];
    }

    public function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new Librerian();
        }
        return self::$_instance;
    }

    public function login($username,$password){
        if($this->_data->username == $username && $this->_data->password == $password){
            Session::put($this->_sessionName, $username);
            return true;
        }
        return false;
    }

    public function logout(){
        if(Session::exists($this->_sessionName)){
            Session::delete($this->_sessionName);
        }
       
    }

    public function addBook($params = array()){
        if(count($params)){
            return $this->_db->insert("books",$params);  
        }
        return false;
    }

    public function deleteBook($id){
        return $this->_db->delete("books",array('id', '=', $id));
    }

    public function isLoggedIn(){
        return $this->_LoggedIn;
    }

}

?>