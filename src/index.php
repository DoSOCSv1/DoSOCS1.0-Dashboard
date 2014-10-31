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
    include("function/headerfooter.php");
    include("function/spdx_doc.php");
    incHeader("SPDX");
    $name = "";
    if(array_key_exists('doc_name',$_POST)) {
    	$name = $_POST['doc_name'];
    }
?>
    <style>
        table.table button.btn {
            margin-right: 5px;
        }
        
        table.table td {
            font-size: 13pt;
        }
    </style>
    <div class="container">
        <h1 class="bold">Docs</h1>
        <div style="width:100%;">
        	<form action="index.php" method="post" style="width:100%;">
        		<input type="text" class="form-control" tabindex="1" autofocus="autofocus" style="display:inline-block;width:70%;" placeholder="Search" value="<?php echo $name; ?>" name="doc_name"/>
        		<button type="submit" class="btn" style="display: inline-block;width:11.5%;margin-left:25px;">Search</button>
        		<button type="button" class="btn btn-primary" onclick="window.location='upload.php'" style="display:inline-block;width:11.5%;margin-left:10px;">Upload Package</button>
        	</form>
        </div>
        <table id="spdx_doc_list" class="table table-striped" >
            <thead>
                <tr>
                    <th>Document #</th>
                    <th>Document Name</th>
                    <th>Created On</th>
                    <th style="text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $result = getSPDX_DocList($name);
                    while($row = mysql_fetch_assoc($result)) {
                        echo '<tr>';
                        echo     '<td>';
                        echo         $row['id'];
                        echo     '</td>';
                        echo     '<td>';
                        echo         '<a href="spdx_doc.php?doc_id=' . $row['id'] . '">' . $row['upload_file_name'] . '</a>';
                        echo     '</td>';
                        echo     '<td>';
                        echo         date('m/d/Y', strtotime($row['created_at'])); 
                        echo     '</td>';
                        echo     '<td style="text-align:right;">';
                        echo         '<div>';
                        echo             '<button type="button" class="btn" onclick="window.open(\'download.php?doc_id=' . $row['id'] . '&format=RDF&doc_name=' . $row['upload_file_name'] . '\',\'_blank\');">Download RDF</button>';
                        echo             '<button type="button" class="btn" onclick="window.open(\'download.php?doc_id=' . $row['id'] . '&format=TAG&doc_name=' . $row['upload_file_name'] . '\',\'_blank\');">Download TAG</button>';
                        echo             '<button type="button" class="btn" onclick="window.open(\'download.php?doc_id=' . $row['id'] . '&format=JSON&doc_name=' . $row['upload_file_name'] . '\',\'_blank\');">Download JSON</button>';
                        echo             '<button type="button" class="btn" onclick="window.location=\'spdx_doc.php?doc_id=' . $row['id'] . '\'">View Details</button>';
                        echo         '</div>';
                        echo     '</td>';
                        echo '</tr>';
                    }
                ?>
             </tbody>
         </table>
    </div>
<?php
    incFooter();
?>
