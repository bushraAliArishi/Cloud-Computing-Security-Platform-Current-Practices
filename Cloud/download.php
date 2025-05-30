<?php
require_once('includes/common.php');
require_once('includes/EncryptionScript.php');
$user_row;
if(sizeof($_SESSION)>0){
    $query = mysqli_query($db_connection, 'select * from users where user_id = ' . $_SESSION['user_id']);
    $user_row = mysqli_fetch_array($query);


    if(!empty($_GET))
    {
        //get file path fromDB
        $query = mysqli_query($db_connection, 'select * from files where file_id = ' . $_GET['file_id']);
        $file_row = mysqli_fetch_array($query);
        $file="cloud_storage/encrypted/".$file_row['file_path'];

        if (file_exists($file)) {
            //get private key for file
            $query = mysqli_query($db_connection, 'select * from user_keys where file_id = ' . $_GET['file_id'].' AND user_id ='.$_SESSION['user_id']);
            $private_key = mysqli_fetch_array($query)['private_key'];
					
            //decrypted file
			$destination="cloud_storage/".$file_row['file_path'];
            decrypt_file($file, $destination, $private_key);
			
			//download
			echo $destination;
            $name=$file_row['file_path'];
			header('Content-Description: File Transfer');
			header('Content-Type: application/force-download');
			header("Content-Disposition: attachment; filename=\"" . basename($destination) . "\";");
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($destination));
			ob_clean();
			flush();
			readfile($destination); //showing the path to the server where the file is to be download
			
			//delete decrypted file
			unlink($destination);
			exit;
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
                            The file
                            <span style="color:red;">
                                <?php echo $file_row['name'];?>
                            </span> has been successfully downloaded. The page will automatic redirect to dashborad after
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