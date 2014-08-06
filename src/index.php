<?php
    include("function/headerfooter.php");
    include("function/spdx_doc.php");
    incHeader("SPDX");
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
        <div style="float: right; width: 11.5%;">
            <button type="button" class="btn btn-primary" onclick="window.location='upload.php'">Upload Package</button>
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
                    $result = getSPDX_DocList();
                    while($row = mysql_fetch_assoc($result)) {
                        echo '<tr>';
                        echo     '<td>';
                        echo         $row['id'];
                        echo     '</td>';
                        echo     '<td>';
                        echo         '<a href="spdx_doc.php?doc_id=' . $row['id'] . '">' . $row['upload_file_name'] . '</a>';
                        echo     '</td>';
                        echo     '<td>';
                        echo         date('d/j/o', strtotime($row['created_at'])); 
                        echo     '</td>';
                        echo     '<td style="text-align:right;">';
                        echo         '<div>';
                        echo             '<button type="button" class="btn" onclick="window.open(\'download.php?doc_id=' . $row['id'] . '&format=RDF&doc_name=' . $row['upload_file_name'] . '\',\'_blank\');">Download RDF</button>';
                        echo             '<button type="button" class="btn" onclick="window.open(\'download.php?doc_id=' . $row['id'] . '&format=TAG&doc_name=' . $row['upload_file_name'] . '\',\'_blank\');">Download TAG</button>';
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