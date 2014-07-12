<?php
	function getSPDX_Doc($spdx_doc_id) {
		//Create Database connection
		include("Data_Source.php");
		mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
		mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());

		//Query
		$sql  = "SELECT spdx_docs.id"; 
		$sql .= ",spdx_version";
		$sql .= ", data_license";
		$sql .= ", document_comment";
		$sql .= ", spdx_docs.updated_at";
		$sql .= ", creator";
		$sql .= ", creators.created_at";
		$sql .= ", creator_comments";
		$sql .= ", package_name";
		$sql .= ", package_version";
		$sql .= ", package_download_location";
		$sql .= ", package_summary";
		$sql .= ", package_file_name";
		$sql .= ", package_supplier";
		$sql .= ", package_originator";
		$sql .= ", package_checksum";
		$sql .= ", package_verification_code";
		$sql .= ", package_description";
		$sql .= ", package_copyright_text";
		$sql .= ", package_license_declared";
		$sql .= ", package_license_concluded";
		$sql .= ", package_license_info_from_files";
		$sql .= " FROM spdx_docs sd" .
		$sql .= " INNER JOIN creators c ON sd.id = c.spdx_doc_id";
		$sql .= " INNER JOIN doc_file_package_associations dfpa ON sd.id = dfpa.spdx_doc_id";
		$sql .= " INNER JOIN packages p ON dfpa.package_id = p.id" .
		$sql .= " WHERE spdx_docs.id = $spdx_doc_id";
		
		//Execute Query
		$qrySPDX_Doc = mysql_query($sql);
		
		//Close Connection
		mysql_close();
		
		return $qrySPDX_Doc;
	}

	function getSPDX_DocList() {
		//Create Database connection
		include("Data_Source.php");
		mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
		mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());

		$query = "SELECT id,upload_file_name,created_at FROM spdx_docs ORDER BY created_at desc";

		//Execute Query
		$qrySpdxDocs = mysql_query($query);
		
		//Close Connection
		mysql_close();
		
		return $qrySpdxDocs;

	}
	function updateSPDX_Doc($spdx_doc_id, $document_comment = "", $spdx_version = "", $data_license = "") {
		//Create Database connection
		include("Data_Source.php");
		mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
		mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());

		//Query
		$sql  = "UPDATE spdx_docs ";
		$sql .= "SET document_comment= $document_comment";
		$sql .= ", spdx_version = $spdx_version";
		$sql .= ", data_license = $data_license";
		$sql .= ", updated_at = now() ";
		$sql .= "WHERE id = $spdx_doc_id";

		//Execute Query
		$qryUpdateDoc = mysql_query($sql);

		//Close Connection
		mysql_close();
	} 
?>