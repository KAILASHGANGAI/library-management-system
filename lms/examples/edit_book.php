<?php
session_start();
include'../database/database.php';
if (!isset($_SESSION['username'])) {
  header("location:login.php");
}
$message= $results= $result="";

if (isset($_GET['edit'])) {
  $id =$_GET['edit'];
  $sql = "SELECT * FROM books WHERE id= '$id'";
  $result = mysqli_query($connect , $sql);

  if (isset($_POST['update_book'])) {

      if (empty($_POST['book_name'])) {
          $message = "<p style='color:red; font-size:20px; text-aline:center;'>Please enter the Book name !!</p>";
       
      }elseif (empty($_POST['book_no'])) {
          $message = "<p style='color:red; font-size:20px; text-aline:center;'>Please enter the book number !!</p>";
        
      }elseif (empty($_POST['auther'])) {
          $message = "<p style='color:red; font-size:20px; text-aline:center;'>Please enter the Auther name !!</p>";
      
      }elseif (empty($_POST['publication'])) {
          $message = "<p style='color:red; font-size:20px; text-aline:center;'>Please enter the Publication name !!</p>";
        
      }elseif (empty($_POST['edition'])) {
          $message = "<p style='color:red; font-size:20px; text-aline:center;'>Please enter the Edition year !!</p>";
        
      }elseif (empty($_POST['price'])) {
          $message = "<p style='color:red; font-size:20px; text-aline:center;'>Please enter the publication date!!</p>";
        
      }else{
        $book_name = $_POST['book_name'];
        $book_no = $_POST['book_no'];
        $auther =$_POST['auther'];
        $publication = $_POST['publication'];
        $edition = $_POST['edition'];
        $price =$_POST['price'];
        if (empty($message)) {
        

          $sqli = "UPDATE `books` SET book_name ='$book_name', book_no='$book_no', auther='$auther', publication='$publication', price='$price',edition='$edition' WHERE id ='$id'";

          if(mysqli_query($connect , $sqli)){

            $result = "<p style='font-size: 20px; color:green;'>Book update successfully</p>";
            header("location:view_total_books.php");

          }else{
            $result = "<p style='font-size: 20px; color:red;'>Book not update successfully</p>".mysqli_error($connect);
          }
        }
      }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Paper Dashboard 2 by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="./dashboard.php">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="./view_member.php">
              <i class="nc-icon nc-diamond"></i>
              <p>View members</p>
            </a>
          </li>
          <li>
            <a href="./view_total_books.php">
              <i class="nc-icon nc-pin-3"></i>
              <p>View total Books</p>
            </a>
          </li>
          <li>
            <a href="./view_issued_books.php">
              <i class="nc-icon nc-bell-55"></i>
              <p>View Issued Books</p>
            </a>
          </li>
          <li>
            <a href="./add_member.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Add member</p>
            </a>
          </li>
          <li>
            <a href="./add_book.php">
              <i class="nc-icon nc-tile-56"></i>
              <p>Add book</p>
            </a>
          </li>
          <li>
            <a href="./issue_book.php">
              <i class="nc-icon nc-caps-small"></i>
              <p>Issue book</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="./setting.php">
              <i class="nc-icon nc-spaceship"></i>
              <p>Setting</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Update Books</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           <ul class="navbar-nav">
             <li class="nav-item">
               <a class="nav-link btn-magnify" href="#pablo">
                 <?php if(isset($_SESSION['username']) )echo $_SESSION['username'];?>
                 <p>
                   <span class="d-lg-none d-md-block">Stats</span>
                 </p>
               </a>
             </li>
             <li class="nav-item btn-rotate dropdown">
               <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i class="nc-icon nc-settings-gear-65"></i>
                 <p>
                   <span class="d-lg-none d-md-block">Setting</span>
                 </p>
               </a>
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                 <a class="dropdown-item" href="logout.php">Logout</a>
                 <a class="dropdown-item" href="#"> Edit profile</a>
                 <a class="dropdown-item" href="#"> Change password</a>
               </div>
             </li>
             <li class="nav-item">
               <a class="nav-link btn-rotate" href="#pablo">
                 <p>
                   <span class="d-lg-none d-md-block">Account</span>
                 </p>
               </a>
             </li>
           </ul>
          </div>
        </div>
      </nav>
     
        <div class="content">
          <?php echo $message;?>
          <?php echo $results;?>
          <div class="row">
            
            <div class="col-md-6 mx-auto">
              <form method="post" action="">
                <?php if (mysqli_num_rows($result) > 0 ): ?>
                  <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="row">
                  <div class=" pl-1 col-md-6">
                    <div class="form-group">
                      <label for="book_name">BOOK_NAME</label>
                      <input type="text" class="form-control" placeholder="Book name" name="book_name" value="<?php echo $row['book_name']; ?>">
                    </div>
                  </div>
                  <div class=" pl-1 col-md-6">
                    <div class="form-group">
                      <label for="book_no">BOOK_NO</label>
                      <input type="text" class="form-control" placeholder=" Book NO" name="book_no"  value="<?php echo $row['book_no']; ?>">
                    </div>
                  </div>
                </div>
                  <div class="row">
                    <div class=" pl-1 col-md-6">
                      <div class="form-group">
                        <label for="AUTHER_NAME"> AUTHER_NAME</label>
                        <input type="text" class="form-control" placeholder="Enter auther name" name="auther"  value="<?php echo $row['auther']; ?>">
                      </div>
                    </div>

                    <div class=" pl-1 col-md-6">
                      <div class="form-group">
                        <label for="publication"> PUBLICATION</label>
                        <input type="text" class="form-control" placeholder=" Enter Publication" name="publication"  value="<?php echo $row['publication']; ?>">
                      </div>

                  </div>
                
                    <div class=" pl-1 col-md-6">
                      <div class="form-group">
                        <label for="edition">EDITION</label>
                        <input type="text" class="form-control" placeholder=" Edition of book" name="edition"  value="<?php echo $row['edition']; ?>">
                      </div>
                    </div>
                       <div class=" pl-1 col-md-6">
                         <div class="form-group">
                           <label for="price"> price: </label>
                           <input type="text" class="form-control" placeholder="Enter price of book" name="price"  
                           value="<?php echo $row['price']; ?>">
                         </div>
                  </div>
                   <?php endwhile; ?>
                 <?php endif; ?>
                 <div class="update ml-auto mr-auto">
                   <button type="submit" class="btn btn-primary btn-round" name="update_book">Add book</button>
                 </div>
                 
              </form>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li>
                  <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
                </li>
                <li>
                  <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                </li>
                <li>
                  <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                </li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
</body>

</html>
