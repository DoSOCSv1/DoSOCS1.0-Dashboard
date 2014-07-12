<?php 
	function updatePackage( $spdx_doc_id, 
							$pacakge_name = "", 
							$package_version = "", 
							$package_download_location = "", 
						    $pacakge_summary = "", 
							$package_file_name = "", 
							$package_supplier = "", 
							$package_originator = "",
							$package_verification_code = "",
							$package_description = "",
							$package_copyright_text = "",
							$package_license_concluded = "") {
		//Create Database connection
		include("Data_Source.php");
		mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
		mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());
		
		//Query
		$sql  = "UPDATE packages, doc_file_package_associations";
		$sql .= "SET packages.package_name = $pacakge_name";
		$sql .= ", packages.package_version = $package_version";
		$sql .= ", packages.package_download_location = $package_download_location";
		$sql .= ", packages.package_summary = $pacakge_summary";
		$sql .= ", packages.package_file_name = $package_file_name";
		$sql .= ", packages.package_supplier = $package_supplier";
		$sql .= ", packages.package_originator = $package_originator";
		$sql .= ", packages.package_verification_code = $package_verification_code";
		$sql .= ", packages.package_description = $package_description";
		$sql .= ", packages.package_copyright_text = $package_copyright_text";
		$sql .= ", packages.package_license_concluded = $package_license_concluded ";
		$sql .= "WHERE doc_file_package_associations.package_id = packages.id";
		$sql .= "AND doc_file_package_associations.spdx_doc_id= $spdx_doc_id";
		
		//Execute Query
		$qryUpdatePackage = mysql_query($sql);
		
		//Close Connection
		mysql_close();
	}
?>