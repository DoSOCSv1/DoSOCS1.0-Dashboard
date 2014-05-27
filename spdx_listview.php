
<h1 class="bold">SPDX Docs List</h1>
		<div class="input-group searchbar" style="float: left; width: 87.5%;">
			<span class="input-group-addon">Search</span>
			<input type="text" class="form-control" onkeyup="filter(this, 'spdx_doc_list', 1)" placeholder="Document Name">
		</div>
		<div style="float: right; width: 11.5%;">
			<button type="button" class="btn btn-primary">Upload Package</button>
		</div>
		
<?php
			$con=mysqli_connect("localhost","root","","spdx");
			// Check connection
			if (mysqli_connect_errno())
			  {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }


			$query = "select id,upload_file_name,created_at from spdx_docs";

			$result = mysqli_query($con,$query);
				echo "<table id=\"spdx_doc_list\" class=\"table table-bordered table-spdx\"><tbody>";

			while($row    = mysqli_fetch_assoc($result))
			  {
			  echo "<tr>";
			  echo "<td class=\"td-timestamp\">
					<p class=\"graybox\">
					<span class=\"glyphicon glyphicon-time\"> </span>".
					$row['created_at'] .        
					"</p> 
					</td>";
			  echo "<td class=\"td-main\">
					<a href=\"/spdx.php?doc_id=". $row['id'] . "\">".$row['upload_file_name']."</a>
					</td>";
			  echo "<td class=\"td-controls graybox\"> 
					<div class=\"btn-toolbar\" role=\"toolbar\">
						<div class=\"btn-group-sm\">
							<button type=\"button\" class=\"btn btn-default\">
								<span class=\"glyphicon glyphicon-download\"> </span>
								Download
							</button>
							<button type=\"button\" class=\"btn btn-default\">
								<span class=\"glyphicon glyphicon-transfer\"> </span>
								Compare
							</button>
						</div>
					</div>
				    </td>";
			  echo "</tr>";
			  }
			  mysqli_free_result($result);
			echo "</tbody></table>";

			mysqli_close($con);
		?> 