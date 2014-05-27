<?php
if(array_key_exists('doc_id',$_GET)){
$spdxId = $_GET["doc_id"];
}
else{
$spdxId = $_POST["doc_id"];
}
$con=mysqli_connect("localhost","root","","spdx");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$query = "SELECT DISTINCT " .
                 "spdx_docs.id, spdx_version, data_license, document_comment, spdx_docs.updated_at,creator, creators.created_at, creator_comments, package_name, package_version,
				 package_download_location, package_summary, package_file_name, package_supplier, package_originator, package_checksum, 
				 package_verification_code, package_description,package_copyright_text, package_license_declared, package_license_concluded, 
				 package_license_info_from_files" .
             " FROM ".
                 "spdx_docs" .
             " INNER JOIN " .
                 "creators"  .
             " ON " . 
                 "spdx_docs.id = creators.spdx_doc_id" .
             " INNER JOIN " .
                 "doc_file_package_associations".
             " ON ".
                 "spdx_docs.id = doc_file_package_associations.spdx_doc_id" .
             " INNER JOIN " .
                 "packages" .
             " ON " .
                 "doc_file_package_associations.package_id = packages.id" .
			 " WHERE spdx_docs.id = " . $spdxId; 
				 

$result = mysqli_query($con,$query);

if($result != false){  
	while($rowVal = mysqli_fetch_assoc($result)) {
			$row = $rowVal;
	}
}	


?>
<form id="spdx_form" action="spdx.php" method="post">
<?php
echo "<input type=\"hidden\" name=\"doc_id\" value=\"$spdxId\" />";
echo "<input type=\"hidden\" name=\"action\" value=\"update\" />";
?>
<table id="tblMain" class="table table-bordered table-striped table-doc">
    <thead>
        <tr>
            <th colspan=2s><?php if($result != false)  echo $row["package_name"]; ?>
			
                <input id="edit_doc" type="button" class="btn btn-primary" value="Edit" onclick="hideCol(2);" />
				<button id="save_top" type="submit"  class="btn btn-primary">Save </button>
            </th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td>Version</td>
        <td ng-show="editing"><textarea ng-model="doc.spdx_version" class='form-control'><?php if($result != false)  echo $row["spdx_version"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["spdx_version"]; ?></td>
    </tr>
    <tr>
        <td>Data License</td>
        <td ng-show="editing"><textarea ng-model="doc.data_license" class='form-control'><?php if($result != false)  echo $row["data_license"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["data_license"]; ?></td>
    </tr>
    <tr>
        <td>Document Comment</td>
        <td ng-show="editing"><textarea name="document_comment" ng-model="doc.document_comment" class='form-control'><?php if($result != false)  echo $row["document_comment"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["document_comment"]; ?></td>
    </tr>
    </tbody>
    <thead>
        <tr>
            <th colspan=2>Creation Information</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td>Creator</td>
        <td ng-show="editing"><textarea ng-model="doc.creator" class='form-control'><?php if($result != false)  echo $row["creator"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["creator"]; ?></td>
    </tr>
    <tr>
        <td>Created</td>
        <td><?php if($result != false)  echo $row["created_at"]; ?></td>
    </tr>
    <tr>
        <td>Updated</td>
        <td><?php if($result != false)  echo $row["updated_at"]; ?></td>
    </tr>
    <tr>
        <td>Creator Comment</td>
        <td ng-show="editing"><textarea ng-model="doc.creator_comments" class='form-control'><?php if($result != false)  echo $row["creator_comments"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["creator_comments"]; ?></td>
    </tr>
    </tbody>
    <thead>
        <tr>
            <th colspan=2>Package Information</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td>Package Name</td>
        <td ng-show="editing"><textarea ng-model="doc.package_name" class='form-control'><?php if($result != false)  echo $row["package_name"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["package_name"]; ?></td>
    </tr>
    <tr>
        <td>Package Version</td>
        <td ng-show="editing"><textarea ng-model="doc.package_version" class='form-control'><?php if($result != false)  echo $row["package_version"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["package_version"]; ?></td>
    </tr>
    <tr>
        <td>Package Download Location</td>
        <td ng-show="editing"><textarea ng-model="doc.package_download_location" class='form-control'><?php if($result != false)  echo $row["package_download_location"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["package_download_location"]; ?></td>
    </tr>
    <tr>
        <td>Package Summary</td>
        <td ng-show="editing"><textarea ng-model="doc.package_summary" class='form-control'><?php if($result != false)  echo $row["package_summary"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["package_summary"]; ?></td>
    </tr>
    <tr>
        <td>Package File Name</td>
        <td ng-show="editing"><textarea ng-model="doc.package_file_name" class='form-control'><?php if($result != false)  echo $row["package_file_name"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["package_file_name"]; ?></td>
    </tr>
    <tr>
        <td>Package Supplier</td>
        <td ng-show="editing"><textarea ng-model="doc.package_supplier" class='form-control'><?php if($result != false)  echo $row["package_supplier"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["package_supplier"]; ?></td>
    </tr>
    <tr>
        <td>Package Originator</td>
        <td ng-show="editing"><textarea ng-model="doc.package_originator" class='form-control'><?php if($result != false)  echo $row["package_originator"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["package_originator"]; ?></td>
    </tr>
    <tr>
        <td>Package Checksum</td>
        <td><?php if($result != false)  echo $row["package_checksum"]; ?></td>
    </tr>
    <tr>
        <td>Package Verification Code</td>
        <td ng-show="editing"><textarea ng-model="doc.package_verification_code" class='form-control'><?php if($result != false)  echo $row["package_verification_code"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["package_verification_code"]; ?></td>
    </tr>
    <tr>
        <td>Package Description</td>
        <td ng-show="editing"><textarea ng-model="doc.package_description" class='form-control'><?php if($result != false)  echo $row["package_description"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["package_description"]; ?></td>
    </tr>
    <tr>
        <td>Package Copyright Text</td>
        <td ng-show="editing"><textarea ng-model="doc.package_copyright_text" class='form-control'><?php if($result != false)  echo $row["package_copyright_text"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["package_copyright_text"]; ?></td>
    </tr>
    <tr>
        <td>License Declared</td>
        <td><?php if($result != false)  echo $row["package_license_declared"]; ?></td>
    </tr>
    <tr>
        <td>Package License Concluded</td>
		<td ng-show="editing"><textarea ng-model="doc.package_license_concluded" class='form-control'><?php if($result != false)  echo $row["package_license_concluded"]; ?></textarea></td>
        <td ng-show="!editing"><?php if($result != false)  echo $row["package_license_concluded"]; ?></td>
        
    </tr>
    </tbody>
    <thead>
        <tr>
            <th colspan=2>
                File Information
            </th>
        </tr>
    </thead>
    <tbody ng-show='files' ng-repeat='file in files'>
	<?php
	
	$con=mysqli_connect("localhost","root","","spdx");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }


	$query = "SELECT DISTINCT " .
				  "package_files.*, doc_file_package_associations.package_id " .
				  "FROM " .
				  "package_files " .
				  "INNER JOIN " .
				  "doc_file_package_associations " .
				  "ON " .
				  "package_files.id = doc_file_package_associations.package_file_id ";
				  "where package_id = "  . $spdxId; 
				 

	$result = mysqli_query($con,$query);;

	if($result != false){  
		while($record = mysqli_fetch_assoc($result)) {
				echo "<tr>
						<td>File Name</td>
						<td>".$record["file_name"]."</td>
					</tr>
					<tr>
						<td>License Concluded</td>
						<td>".$record["license_concluded"]."</td>
					</tr>
					<tr>
						<td>File Comment</td>
						<td>".$record["file_comment"]."</td>
					</tr>";
		}
	}	
	 
?>
        
    </tbody>
</tbody>
</table>

<button id="save_bottom" type="submit"  class="btn btn-primary">Save </button>
</form>
<?php
  mysqli_free_result($result);

  mysqli_close($con);
?> 