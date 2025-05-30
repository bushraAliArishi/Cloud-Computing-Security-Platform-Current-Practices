<?php
require_once('includes/common.php');
require_once('includes/EncryptionScript.php');
$user_row;
if(sizeof($_SESSION)>0){
    $query = mysqli_query($db_connection, 'select * from users where user_id = ' . $_SESSION['user_id']);
    $user_row = mysqli_fetch_array($query);
    $target_name = uniqid();
    if(!empty($_POST))
    {
        //print_r($_FILES);

        $target_name = $target_name .'.' .end(explode(".", $_FILES["uplaod_file"]["name"]));

        // Check file size
        if ($_FILES["uplaod_file"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error

        if (move_uploaded_file($_FILES["uplaod_file"]["tmp_name"], 'cloud_storage/'.$target_name)) {

            //create private key for file
            $private_key = md5(microtime().rand());

            //encrypted file
            encrypt_file('cloud_storage/'.$target_name, "cloud_storage/encrypted/".$target_name, $private_key);

            //delete normal upload file
            unlink('cloud_storage/'.$target_name);

            //insert into DB
            mysqli_query($db_connection, 'INSERT INTO files (name, file_path, last_update) VALUES ("'.trim($_POST['name']).'","'.$target_name.'", NOW())');
            $query= mysqli_query($db_connection, 'SELECT LAST_INSERT_ID();');
            $row = mysqli_fetch_array($query);
            $file_id=$row[0];
            mysqli_query($db_connection, 'INSERT INTO files_users (user_id, file_id) VALUES ('.$_SESSION['user_id'].','.$file_id.')');

            //insert private key in DB
            mysqli_query($db_connection, "INSERT INTO user_keys (file_id, user_id, private_key, create_date) VALUES ( ".$file_id.", ".$_SESSION['user_id'].", '".$private_key."', '".date('Y-m-d H:i:s')."')");
            
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

    }
    else
    {
        header('Location: index.php');
    }
}
else
{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Area | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
</head>

<body>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Cloud Computing Security Platform Current Practices</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="index.php">Files</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#">
                            Welcome, <?php echo $user_row['name'];?>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1>
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Upload File
                        <small></small>
                    </h1>
                </div>
                
            </div>
        </div>
    </header>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Website Overview -->
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Well done!</h4>
                        <p>
                            The file has been successfully uploaded. The page will automatic redirect to dashborad after
                            <span id="timer">5</span> seconds.
                        </p>
                        <hr />
                        <p class="mb-0">
                            Back now to your
                            <a href="index.php">dashboard</a>.
                        </p>
                    </div>



                    <script type="text/javascript">

                        var counter = 5;
                        var interval = setInterval(function () {
                            document.getElementById('timer').innerHTML = counter;
                            counter--;

                            if (counter == 0) {
                                // Display a login box
                                window.location.href = "index.php";
                            }
                        }, 1000);
                    </script>


                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <p>Copyright &copy; 2017</p>
    </footer>



    <script>
        CKEDITOR.replace('editor1');
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>