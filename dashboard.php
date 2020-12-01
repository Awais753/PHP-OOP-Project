<?php
require_once 'core/init.php';


if(isset($_POST['book_add'])){
   
    $fields = array(
        'title' => Input::get('title'),
        'category' => Input::get('category'),
        'author' => Input::get('author'),
        'description' => Input::get('description'),
        'avavilable' => 1,
        'quantity' => Input::get('quantity')
    );  
}

$books = Database::getInstance()->query("SELECT * FROM books")->results();
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
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
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
            <h1>Administrator Portal</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h2>Delete a Book</h2>
        <?php
            if(isset($_POST['book_delete'])){
                $db = Database::getInstance();
                $row = $db->get("books",array("id","=",Input::get('book')))->results()[0];
                unlink("img/".$row->image);
                if(!Librerian::getInstance()->deleteBook(Input::get('book'))->error()){
                    echo Validate::flash("success","Book was deleted successfuly!");
                }
            }
        ?>
        <form action="" method="post">
                <div class="form-group controls">
                  <label for="book">List of Books</label>
                  <select class="form-control" name="book" id="book">
                    <?php
                        foreach($books as $book) {
                            ?>
                                <option value="<?php echo $book->id ?>"><?php echo $book->title ?></option>

                            <?php
                        }
                    ?>
                  </select>
                </div>
            <button type="submit" class="btn btn-primary" name="book_delete" value="book_delete">Delete</button>
        </form>
        <br>
        <hr>
        <br>
        <div>
            <h2>Add a Book</h2>
            <?php
                if(isset($_POST['book_add'])){

                    if(!Validate::book($fields['title'])){
                        $allowedExts = array("gif", "jpeg", "jpg", "png");
                        $temp = explode(".", $_FILES["file"]["name"]);
                        $extension = end($temp);
                        if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/x-png") || ($_FILES["file"]["type"] == "image/png")) && in_array($extension, $allowedExts)) {
                            if ($_FILES["file"]["error"] > 0) {
                                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                            } else {
                        
                                $fileName = $temp[0] . "." . $temp[1];
                                $temp[0] = rand(0, 3000); //Set to random number
                                $fileName;
                        
                                if (file_exists("img/" . $_FILES["file"]["name"])) {
                                    echo $_FILES["file"]["name"] . " already exists. ";
                                } else {
                                    
                                    $fields['image'] = $fields['title'].".".$extension;
                                    move_uploaded_file($_FILES["file"]["tmp_name"], "img/" . $fields['image']);
                                }
                            }
                        } else {
                            echo "Invalid file";
                        }
                        if(Librerian::getInstance()->addBook($fields)){
                            echo Validate::flash("success","Book was added successfuly!");
                        }
        
                    }else{
                        echo Validate::flash("danger","Book already exists!");
                    }
                }
               
            ?>
            <form name="sentMessage" id="contactForm" action="" method="post" enctype="multipart/form-data">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Book Title" id="title" required data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                    <label>Author</label>
                    <input type="text" name="author" class="form-control" placeholder="Author Name" id="author" required data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <label for="category">Category</label>
                    <select class="form-control" name="category" id="category" required data-validation-required-message="Please enter Category.">
                        
                        <option selected value="Science">Science</option>
                        <option value="Short Stories">Short Stories</option>
                        <option value="Essays">Essays</option>
                        <option value="History">History</option>
                        <option value="Poetry">Poetry</option>
                        <option value="Math">Math</option>
                        <option value="Religious">Religious</option>
                    
                    </select>
                    <p class="help-block text-danger"></p>
                   
          
                  </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                    <label>Description</label>
                    <textarea class="form-control" name="description" id="" rows="3" placeholder="Book Description"></textarea>
                    <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" id="quantity" required data-validation-required-message="Please enter your Quantity.">
                    <p class="help-block text-danger"></p>
                    </div>
                </div>
                
                <br>
                <div class="form-group">
                  <label for="">Upload Book Cover</label>
                  <input type="file" class="form-control" name="file" id="file" >
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="book_add" value="book_add">Add</button>
            </form>
        </div>
        
      </div>
    </div>
  </div>

  <hr>

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
