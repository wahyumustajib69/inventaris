<?php
    ob_start();
    session_start();
    include ("koneksi.php");
    if(isset($_SESSION['username'])){
    header("location:login");
    }else{
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN DMM</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link rel="icon" type="text/css" href="fpdf/logo.png">
</head>
<body class="bg-primary">
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                
                 <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                              <i class="fa fa-user"></i> <strong align="center"> LOGIN INVENTARIS</strong>  
                            </div>
                            <div class="panel-body">
                              <h2 class="text-center"><img src="fpdf/logo.png" style="height: 100px;"></h2>
                                <form role="form" method="post" action="login_proses.php">
                                       <br />
                                     <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                        <input type="text" name="username" class="form-control" placeholder="Username" autofocus="autofocus" required="required" />
                                      </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="password" class="form-control"  placeholder="Password" required="required" />
                                        </div>
                                    <div class="form-group">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" /> Ingat saya
                                            </label>
                                            <span class="pull-right">
                                                   <a href="#" >Lupa password ? </a> 
                                            </span>
                                        </div>
                                     
                                     <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-sign-in"></i> LOGIN</button>
                                    </form>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
<?php } ?>