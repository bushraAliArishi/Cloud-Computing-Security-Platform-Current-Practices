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
            <h1 class="text-center">Account Login</h1>
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <form id="login" action="login.php" class="well" method="post">
                  <div style="color:red;">
                      <?php
                    if (!empty($_POST)){

                        if(trim($_POST['email']) == "")
                            echo "Please enter email address.";
                        else if($_POST['password'] == "")
                            echo "Please enter password.";
                        else
                        {
                            // encrypt password as md5
                            $encrpt_paasword =md5($_POST['password']);

                            $sql_txt ='SELECT * FROM users WHERE email = "'.strtolower(trim($_POST['email'])).'" AND password = "'.$encrpt_paasword.'"';

                            $query = mysqli_query($db_connection, $sql_txt);
                            if(mysqli_num_rows($query) > 0)
                            {
                                $row = mysqli_fetch_array($query);
                                $_SESSION['user_id']= $row['user_id'];
                                header('Location: index.php');;
                            }
                            else
                            {
                                echo 'The email address or password is invalid.';
                            }

                        }
                    }
                      ?>
                  </div>
                  <div class="form-group">
                      <label>Email Address</label>
                      <input type="text" class="form-control" placeholder="Enter Email" name="email" />
                  </div>
                  <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" placeholder="Password" name="password" />
                  </div>
                  <button type="submit" class="btn btn-default btn-block">Login</button>
                  <a href="register.php" class="btn btn-block btn-primary">Register</a>
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
