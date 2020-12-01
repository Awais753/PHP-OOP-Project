<?php
 require_once 'core/init.php';

 if(!Session::exists(Config::get('session/session_name'))){
    Redirect::to('register.php');
 }

 ?>
 <!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>“Al Mabade School Library</title>

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
  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Home</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
    <?php
      if(count($books)){
          foreach ($books as $book) {?>
            <div class="col-md-4">
              <figure class="card card-product">
                <div class="img-wrap"><img src="img/<?php echo $book->image?>" width="100%"></div>
                  <hr>
                  <figcaption class="info-wrap" >
                      <h4 class="title"><?php echo $book->title ?></h4>
                      <p class="desc">Author: <?php echo $book->author ?></p>
                      <div class="rating-wrap">
                        <div class="label-rating">Qty:<?php echo $book->quantity ?></div>
                      </div> <!-- rating-wrap.// -->
                  </figcaption>
                  <hr>
                <div class="bottom-wrap">
                  <a href="single.php?id=<?php echo $book->id ?>" class="btn btn-sm btn-primary float-right">Borrow Now</a>	
                    <div class="price-wrap h5">
                      <span class="price-new"><?php //echo $book->price ?></span>
                    </div> <!-- price-wrap.// -->
                </div> <!-- bottom-wrap.// -->
              </figure>
            </div>
            <?php
          }
      }else{
          echo Validate::flash("primary","No book Available currently!");
      }

    ?>
    
      
    </div>
  </div>

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
