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
    <script type="text/javascript">
	
	function filter (term, _id, cellNr){
	var suche = term.value.toLowerCase();
	var table = document.getElementById(_id);
	var ele;
	for (var r = 0; r < table.rows.length; r++){
		ele = table.rows[r].cells[cellNr].innerHTML.replace(/<[^>]+>/g,"");
		if (ele.toLowerCase().indexOf(suche)>=0 )
			table.rows[r].style.display = '';
		else table.rows[r].style.display = 'none';
	}
	}
	function hideCol(col) {
	         
			 if(col == 1){
			 document.getElementById("save_top").style.display="none";
			 document.getElementById("save_bottom").style.display="none";
			 }
			 else{
			 document.getElementById("save_top").style.display="";
			 document.getElementById("save_bottom").style.display="";
			 document.getElementById("edit_doc").style.display="none";
			 }
             var tbl = document.getElementById("tblMain");

                for (var i = 1; i < tbl.rows.length; i++) {

                    for (var j = 0; j < tbl.rows[i].cells.length; j++) {

                        tbl.rows[i].cells[j].style.display = "";
                        if(tbl.rows[i].cells[j].innerHTML == 'File Name')
						 return;
                        if (j == col)

                            tbl.rows[i].cells[j].style.display = "none";
						

                    }

                }

            }
	</script>
	
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
      <a class="navbar-brand" href="http://spdxhub.ist.unomaha.edu/">SPDX Hub</a>
      <a class="navbar-brand" href="https://fossologyspdx.ist.unomaha.edu/" target="_blank">Fossology+SPDX</a>
      <div class="pull-right" ng-controller="pluginCtrl">
          <a class="navbar-brand" ng-repeat="plugin in plugins" ng-if="plugin.active" ng-href="{{plugin.url}}">{{plugin.name}}</a>
      </div>
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
		
		if(array_key_exists('action',$_POST)){
		    if($_POST["action"] == "update"){
			 $docs = "UPDATE spdx_docs " .
                  "SET document_comment='" .  $_POST["document_comment"] ."'".
                  " WHERE id=" . $_POST["doc_id"];
				  
			$con=mysqli_connect("localhost","root","","spdx");
			// Check connection
			if (mysqli_connect_errno())
			  {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
			mysqli_query($con,$docs);
			mysqli_close($con);
			include 'spdx_docview.php';			
			}
		}
		else if(array_key_exists('doc_id',$_GET)){
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