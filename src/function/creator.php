<SPDX-License-Identifier: Apache-2.0>
<!--
Copyright (C) 2014 University of Nebraska at Omaha.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
-->
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
