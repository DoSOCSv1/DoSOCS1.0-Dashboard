<?php
    function updateCreator($spdx_doc_id, $creator = "", $creator_comments = "") {
        //Create Database connection
        include("Data_Source.php");
        mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
        mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());

        //Query
        $sql  = "UPDATE creators 
                SET creator = '" . $creator . "', 
                    creator_comments = '" . $creator_comments . "'
                WHERE spdx_doc_id = " . $spdx_doc_id;

        //Execute Query
        $qryUpdateCreator = mysql_query($sql);

        //Close Connection
        mysql_close();
    } 
?>