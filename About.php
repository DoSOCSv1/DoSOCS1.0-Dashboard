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
      <a class="navbar-brand" href="Home.php">About</a>
     <!--  <div class="pull-right" ng-controller="pluginCtrl">
          <a class="navbar-brand" ng-repeat="plugin in plugins" ng-if="plugin.active" ng-href="{{plugin.url}}">{{plugin.name}}</a>
      </div> -->
          <div class="container-fluid nav-collapse">
            <ul class="nav">
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
    
<p>FOSSology+SPDX aims to support the advancement of tooling to produce SPDX documents from the FOSSology open source package scanner. This tool supports the integration of the SPDX standard into current license scanning practices. SPDX or The Software Package Data Exchange specification is a standard format for communicating the components, licenses and copyrights associated with a software package (http://spdx.org/ 2014). FOSSology is a source code scanning tool used to identify license and copyright.</p>
<p>The University of Nebraska at Omaha Open Systems development class is currently creating other tools to facilitate the use of SPDX documents for the business setting. These tools include a web based dashboard to view SPDX documents in a more user friendly way. Another tool the class has been developing is the SPDX Product History Utility, which will allow business to associate products with software packages in order to inventory which software licenses and copyrights are on their products.</p>


</div> 
    <div class='container' align='center'>
      <footer>
        <p>&copy; University of Nebraska at Omaha 2014<p>
      </footer>
    </div>
  </body>

</html>