<!DOCTYPE html>
<html lang="en" ng-app="dashApp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js" type="text/javascript"></script>
    <![endif]-->
    
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="bower_components/bootstrap/dist/css/bootstrap-theme.css" rel="stylesheet">
    <script type="text/javascript" src="js/common.js"></script>
	
  </head>
  <body onload="hideCol(1);">

    <div class="navbar navbar-default navbar-static-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
	  <a class="navbar-brand" href="spdx.php">Home</a>
      <a class="navbar-brand" href="http://spdxhub.ist.unomaha.edu/" target="_blank">SPDX Hub</a>
      <a class="navbar-brand" href="https://fossologyspdx.ist.unomaha.edu/" target="_blank">Fossology+SPDX</a>
       <a class="navbar-brand" href="About.php">About</a>    
          <div class="container-fluid nav-collapse">
            <ul class="nav">
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
		
        <!-- Placeholder for dashboard views -->
		<?php 
		
		if(array_key_exists('doc_id',$_GET)){
			include 'spdx_docview.php';
		}else{
			include 'spdx_listview.php';
		}
		
		
		?>
	    
    </div> 
    <div class='container'>
      <footer>
        <p>&copy; University of Nebraska at Omaha 2014<p>
      </footer>
    </div>
  </body>

</html>