<?php
 require_once 'core/init.php';
 $user = new User();
 if(Input::exists('get')){
    $book = Database::getInstance()->get("books",array('id', '=', Input::get('id')))->results()[0];
 }

 if(isset($_POST['rent_btn'])){ 
 //var_dump($book);
     
     if($book->quantity>=0){
      $book->quantity--;
       if(!Database::getInstance()->query("UPDATE `books` SET `quantity` = ".$book->quantity." WHERE `id` = ".$book->id." ")->error()){
          $book = Database::getInstance()->get("books",array('id', '=', Input::get('id')))->results()[0];
       }
       if($book->quantity==0){
        if(!Database::getInstance()->query("UPDATE `books` SET `avavilable` = 0 WHERE `id` = ".$book->id." ")->error()){
          $book = Database::getInstance()->get("books",array('id', '=', Input::get('id')))->results()[0];
        }
       }
     }
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Al Mabade School Library</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.php">Al Mabade School Library</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1><?php echo $book->title ?></h1>
            <span class="meta"><b>Ahuthor: </b><?php echo $book->author ?></span>
            <hr>
            <span class="meta"><b>Category: </b><?php echo $book->category ?></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto" >
              <div class="img-wrap"><img src="img/<?php echo $book->image?>" width="100%"></div>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-10">
        <br>
        <h3>Description</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-10" >
            <pre>
                <?php echo $book->description?>
            </pre>
        </div>
      </div>
      <br>
      <hr>  
      <br>
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        <?php 
            if($book->quantity>0){?>
              <h3>Borrow Book</h3>
              <form name="sentMessage" id="contactForm" action="" method="post">
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <label>Return Date</label>
                    <input type="date" name="rtn_date" class="form-control" placeholder="rtn_date" id="rtn_date" required data-validation-required-message="Please enter return Date.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
    
                <br>
                
                <button type="submit" class="btn btn-primary" name="rent_btn" id="sendMessageButton">Borrow</button>
              </form>
              <?php
            }else{
              echo Validate::flash("danger", "No Copies left for Borrow!!!");
            }
        ?>
        
        </div>
      </div>
      

    </div>
  </article>
<br>
  <hr>
<br>
  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fas fa-envelope fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li>
            <a href="#">
                <span>
                  <b>librerian@lms.com</b>
                </span>
              </a>
              
            </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; Your Website 2020</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
