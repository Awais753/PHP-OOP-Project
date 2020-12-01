<!DOCTYPE html>
<html lang="en">
<?php
require_once 'core/init.php';
?>


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
          <?php
            if(!Session::exists(Config::get('session/session_name'))){?>
              <li class="nav-item">
                <a class="nav-link" href="login_admin.php">Admin Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">User Login</a>
              </li>
              <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Register</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div>
        <?php
            if(Input::exists()){
                
                $fields=array(
                    'username'=>Input::get('name'),
                    'email'=>Input::get('email'),
                    'password'=>Input::get('password'),
                    'grade'=>Input::get('grade')
                );
               
                $user = new User;
                if(!Validate::userName($fields['username'])){
                    if(!Validate::email($fields['email'])){
                        if($user->create($fields)){
                          echo Validate::flash("success", "User created successfully");
                        }    
                    }else{
                      echo Validate::flash("danger", "Email already exists");
                    }   
                }else{
                    echo Validate::flash("danger", "Username already exists");   
                }
            }
    
        ?>
        </div>
        <form name="sentMessage" id="contactForm" action="" method="post">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <input type="text" name="name" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email Address</label>
              <input type="email" name="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Password</label>
              <input type="password" name="password" class="form-control" placeholder="Password" id="password" required data-validation-required-message="Please enter your Password.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Grade</label>
              <p class="help-block text-danger"></p>
              <select class="form-control" name="grade" id="grade" required data-validation-required-message="Please enter your Grade.">
                  <?php
                  
                    for ($i=1; $i <= 12 ; $i++) { ?>
                      <option value="<?php echo $i?>"><?php echo $i;?></option>

                      <?php
                    }
                  ?>
                  
              </select>
    
            </div>
          </div>
          <br>
          <div>
          
          </div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Register</button>
        </form>
      </div>
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

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
