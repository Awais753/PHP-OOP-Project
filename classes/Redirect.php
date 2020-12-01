<?php 
class Redirect{
    public function to($location = null){
        if($location){
            header('Location: '.$location);
            exit();
        }

    }
}
?>