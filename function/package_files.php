<?php function getPackageFiles($spdx_doc_id) {
		//Create Database connection
		include("Data_Source.php");
		mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
		mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());

		//Query
		$sql  = "SELECT DISTINCT ";
		$sql .= "pf.*, dfpa.package_id ";
        $sql .= "FROM package_files pf";
        $sql .= "INNER JOIN doc_file_package_associations dfpa ON pf.id = dfpa.package_file_id ".
        $sql .= "WHERE package_id = $spdx_doc_id";
		
		//Execute Query
		$qryPKGFiles = mysql_query($sql);
		
		//Close Connection
		mysql_close();
		
		return $qryPKGFiles;
	}
?>