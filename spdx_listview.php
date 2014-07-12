<?php
    include("function/spdx_doc.php");
?>
<h1 class="bold">Docs</h1>
		<div class="input-group searchbar" style="float: left; width: 87.5%;">
			<span class="input-group-addon">Search</span>
			<input type="text" class="form-control" onkeyup="filter(this, 'spdx_doc_list', 1)" placeholder="Document Name">
		</div>
		<div style="float: right; width: 11.5%;">
			<button type="button" class="btn btn-primary" onclick="window.location='upload.php'">Upload Package</button>
		</div>
		
<?php
    $result = getSPDX_DocList();
    echo "<table id=\"spdx_doc_list\" class=\"table table-bordered table-spdx\"><tbody>";

    while($row = mysql_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class=\"td-timestamp\">";
        echo "<p class=\"graybox\">";
		echo "<span class=\"glyphicon glyphicon-time\"> </span>";
        echo $row['created_at']; 
		echo "</p>"; 
		echo "</td>";
        echo "<td class=\"td-main\">";
        echo "<a href=\"spdx.php?doc_id=". $row['id'] . "\">" . $row['upload_file_name'] . "</a>";
        echo "</td>";
        echo "<td class=\"td-controls graybox\">";
        echo "<div class=\"btn-toolbar\" role=\"toolbar\">";
        echo "<div class=\"btn-group-sm\">";
        echo "<button type=\"button\" class=\"btn btn-default\">";
        echo "<span class=\"glyphicon glyphicon-download\"> </span>";
        echo "Download";
        echo "</button>";
        echo "<button type=\"button\" class=\"btn btn-default\">";
        echo "<span class=\"glyphicon glyphicon-transfer\"> </span>";
        echo "Compare";
        echo "</button>";
        echo "</div>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
?> 