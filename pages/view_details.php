
<?php
	require "connect.php";
	session_start();
	$id=$_SESSION['id'];
	$user=$_SESSION['user'];
	$sql="select count(*) from link_counter where uid=$id";
	$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($out=mysqli_fetch_row($result))
	{
		$count=$out[0];
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>URL Shortner</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">URL Shortner</a>
            </div>
            <!-- /.navbar-header -->
			<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <div>
                                <p style="font-weight: bold; margin: 30px 0px 20px 95px; color: #4d79ff"> Menu </p>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-edit fa-fw"></i> Login </a>
                        </li>
						<li>
                            <a href="bargraph.php"><i class="fa fa-bar-chart-o fa-fw"></i> View Analysis </a>
                        </li>
						<li>
                            <a href="logout.php"><i class="fa fa-power-off fa-fw"></i> Logout </a>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Welcome <?php echo $user; ?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Your shortened URLs
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table class="table table-hover">
								<tr>
								<th> URLs </th>
								<th> Shortened URLs </th>
								<th> Code </th>
								<th> Count </th>
								</tr>
								<?php
									
									$sql="SELECT distinct links.code,url,link_counter.count FROM link_counter,links Where link_counter.uid='$id' and links.id IN (SELECT distinct url_id FROM user_links WHERE  uid='$id');";
									$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
									while($row = $result->fetch_row()) 
									{
										
								?>
								<tr>
									<td> <?php echo $row[1]; ?> </td>
									<td> <a href="link_counter.php?url=http://localhost/urlshort/<?php echo $row[0]; ?>">http://localhost/urlshort/<?php echo $row[0]; ?> </a> 
									</td>
									<td> <?php echo $row[0]; ?> </td>
									<td> <?php echo $row[2]; ?> </td>
									
								</tr>
								<?php 
									}
								?>
								</table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    
                </div>
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
