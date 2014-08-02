<?php
    function incHeader($title) {
        echo '<!DOCTYPE html>';
        echo '<html lang="en" ng-app="dashApp">';
        echo     '<head>';
        echo         '<meta charset="utf-8">';
        echo         '<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">';
        echo         '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo         '<title>' . $title . '</title>';
        echo         '<link href="css/dashboard.css" rel="stylesheet">';
        echo         '<link href="css/bootstrap.css" rel="stylesheet">';
        echo         '<link href="css/bootstrap-theme.css" rel="stylesheet">';
        echo         '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
        echo    '</head>';
        echo     '<body>';
        //NavBar
        echo         '<div class="navbar navbar-default navbar-static-top">';
        echo             '<div class="navbar-inner">';
        echo                '<div class="container-fluid">';
        echo                    '<a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">';
        echo                         '<span class="icon-bar"></span>';
        echo                         '<span class="icon-bar"></span>';
        echo                        '<span class="icon-bar"></span>';
        echo                     '</a>';
        echo                     '<a class="navbar-brand" href="index.php">Home</a>';
        echo                     '<a class="navbar-brand" href="http://spdxhub.ist.unomaha.edu/" target="_blank">SPDX Hub</a>';
        echo                     '<a class="navbar-brand" href="https://fossologyspdx.ist.unomaha.edu/" target="_blank">Fossology+SPDX</a>';
        echo                     '<a class="navbar-brand" href="About.php">About</a>';
        echo                     '<div class="container-fluid nav-collapse">';
        echo                         '<ul class="nav">';
        echo                         '</ul>';
        echo                     '</div>';
        echo                 '</div>';
        echo             '</div>';
        echo         '</div>';
    }
    
    function incFooter() {
        echo         '<div class="container col-md-3 col-md-offset-5" style="margin-top:10px;">';
        echo             '<footer>';
        echo                 '<p>&copy; University of Nebraska at Omaha 2014<p>';
        echo             '</footer>';
        echo         '</div>';
        echo     '</body>';
        echo '</html>';
    }
    

?>