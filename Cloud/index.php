<?php
require_once('includes/common.php');
$user_row;
if(sizeof($_SESSION)>0){
    $query = mysqli_query($db_connection, 'select * from users where user_id = ' . $_SESSION['user_id']);
    $user_row = mysqli_fetch_array($query);
}
else
{
    header('Location: login.php');
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
                        <a href="#">Welcome, <?php echo $user_row['name'];?></a>
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
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
                        <small></small>
                    </h1>
                </div>
                <div class="col-md-2">
                    <div class="dropdown create">
                        <button class="btn btn-default btn-block" type="button" data-target="#upload-modal" data-toggle="modal">
                            Upload
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Website Overview -->
                    <div class="panel panel-default">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Manage your Files</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <!--This form for search-->
                                <form enctype="multipart/form-data" action="index.php" method="post">
                                    <div class="col-md-11">
                                        <input name="search" class="form-control" type="text" placeholder="Filter Files..." value="<?php if(!empty($_POST)){echo $_POST['search'];}?>" />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="submit" class="btn btn-success btn-block" value="search" />
                                    </div>
                                </form>
                            </div>
                            <br />
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th class="col-xs-6">Title</th>
                                    <th class="col-xs-6"></th>
                                </tr>
                                <?php
                                //This POST var to get search box text
                                if(!empty($_POST))
                                {
                                    $sql_txt="select * from files where file_id in (SELECT file_id FROM files_users WHERE user_id =".$_SESSION['user_id'].") and name like'%".trim($_POST['search'])."%'";
                                }
                                else
                                {
                                    $sql_txt="select * from files where file_id in (SELECT file_id FROM files_users WHERE user_id =".$_SESSION['user_id'].")";
                                }
                                
                                $query = mysqli_query($db_connection, $sql_txt);
                                while($row = mysqli_fetch_array($query))
                                {
                                ?>

                                <tr>
                                    <td>
                                        <?php echo $row['name'];?>
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-default" href="Download.php?file_id=<?php echo $row['file_id'];?>">Download</a>
                                        <a class="btn btn-danger" href="Delete.php?file_id=<?php echo $row['file_id'];?>">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <p>Copyright &copy; 2017</p>
    </footer>

    <!-- Modals -->

    <!-- Add Page -->
    <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" action="upload.php" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Upload File</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>File Name</label>
                            <input type="text" class="form-control" placeholder="File Title" name="name" />
                        </div>
                        <div class="form-group">
                            <label>Browse</label>
                            <input type="file" name="uplaod_file"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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