<?php
	include("connect.php");
	if(!isset($_REQUEST['pg'])){ $pg = "board"; } else { $pg = $_REQUEST['pg']; }
	$_SESSION["id"] = 1;
	if(isset($_SESSION["id"])){
		$user = mysqli_fetch_array(mysqli_query($con,"select * from resources where id=$_SESSION[id] limit 1"));
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>HBoard</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3" href="index.html">HBoard&trade;</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="index.php?pg=account">Account</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Planning</div>
                            <a class="nav-link" href="index.php?pg=board">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Board
                            </a>
                            <a class="nav-link" href="index.php?pg=backlog">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Back Logs
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
						<?php
						if(isset($_SESSION["id"])){
						?>
							<div class="small">Logged in as:</div>
							<?php echo $user["firstname"]." ".$user["lastname"];?>
						<?php
						}
						?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
					<?php
						if($pg=="board")include("board.php");
						if($pg=="backlog")include("backlog.php");
						if($pg=="newtask")include("newtask.php");
						if($pg=="details")include("details.php");
					?>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; HBoard 2024</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/Sortable.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
