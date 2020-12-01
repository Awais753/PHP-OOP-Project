<?php
class User{
    private $_db;
    private $_data;
    private $_selectedBook;
    private $_sessionName;
    private $_LoggedIn = false;
    
    public function __construct($user = null){
        $this->_db=Database::getInstance();
        $this->_sessionName=Config::get('session/session_name');
        if(!$user){
            if(Session::exists(Config::get('session/session_name'))){
                $user = Session::get(Config::get('session/session_name'));
                if($this->_db->get("users",array(
                    'username',
                    '=',
                    $user
                ))){
                    $this->_data = $this->_db->results()[0];
                    $this->_isLoggedIn = true;
                }
            }
            
        }
    }

    public function create($fields = array()){
        return $this->_db->insert('users',$fields);
    }

    public function login($username,$password){
        $this->_db->get("users",array(
            'username',
            '=',
            $username
        ));
        if($this->_db->results()[0]->username == $username && $this->_db->results()[0]->password){
            Session::put($this->_sessionName, $username);
            $this->_data = $this->_db->results()[0];
            return true;
        }
        return false;
    }

    public function logout(){
        if(Session::exists($this->_sessionName)){
            Session::delete(Config::get('book/selected_book'));
            Session::delete($this->_sessionName);
        }
       
    }

    public function isLoggedIn(){
        return $this->_LoggedIn;
    }

    public function selectBook($id){
        $this->_selectedBook = $id;
    }

    public function selectedBook(){
        return $this->_selectedBook;
    }
}
?>