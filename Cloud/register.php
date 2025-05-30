<?php
require_once('includes/common.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Account Login</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Cloud Computing Security Platform Current Practices</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center">Account registration</h1>
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <form id="register" action="register.php" class="well" method="post">
                  <div style="color:red;">
                      <?php
                      if (!empty($_POST)){
                          if(trim($_POST['name']) == "")
                              echo "Please enter name.";
                          else if(trim($_POST['email']) == "")
                              echo "Please enter email.";
                          else if(trim($_POST['date_of_birth']) == "")
                              echo "Please enter date of birth.";
                          else if($_POST['password'] == "" || $_POST['re_password'] == "")
                              echo "Please enter password.";
                          else if($_POST['password'] != $_POST['re_password'])
                              echo "Password does not match the confirm password field.";

                          else
                          {
                              // encrypt password as md5
                              $encrpt_paasword =md5($_POST['password']);

                              $sql_txt ='INSERT INTO users (name, email, date_of_birth, password, gender) VALUES ("'.trim($_POST['name']).'","'.trim($_POST['email']).'", "'.trim($_POST['date_of_birth']).'", "'.strval($encrpt_paasword).'", '.intval($_POST['gender']).')';
                              //echo $sql_txt;
                              mysqli_query($db_connection, $sql_txt);

                              $query = mysqli_query($db_connection, 'select * from users where Email = \'' . strtolower(trim($_POST['email'])) . '\'');
                              if(mysqli_num_rows($query) > 0)
                              {
                                  $row = mysqli_fetch_array($query);
                                  $_SESSION['user_id']= $row['user_id'];
                                  header('Location: index.php');
                              }
                              else
                              {
                                  $error_message = "Error!";
                              }

                          }
                      }
                      ?>
                  </div>
                  <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" placeholder="Enter User name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>" />
                  </div>
                  <div class="form-group">
                      <label>Email address</label>
                      <input type="text" name="email" class=" form-control" placeholder="Enter Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" />
                  </div>
                  <div class="form-group">
                      <label>Date of birth</label>
                      <input type="date" name="date_of_birth" class="form-control" placeholder="Enter Date of birth" value="<?php if(isset($_POST['date_of_birth'])) echo $_POST['date_of_birth'];?>" />
                  </div>
                  <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Password" />
                  </div>
                  <div class="form-group">
                      <label>Re-enter Password</label>
                      <input type="password" name="re_password" class="form-control" placeholder="Password" />
                  </div>
                  <div class="form-group">
                      <label>Gender</label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="radio" value="0" name="gender" checked/> Male
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="radio" value="1" name="gender" /> Female
                      </label>
                  </div>
                  <button type="submit" class="btn btn-default btn-block">Submit</button>
              </form>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright &copy; 2019</p>
    </footer>

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
