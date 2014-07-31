<?php
    include("function/headerfooter.php");
    include("function/spdx_doc.php");
    include("function/creator.php");
    include("function/package.php");
    include("function/package_files.php");
    incHeader("SPDX");
    
    $spdxId = $_GET["doc_id"];
    if(array_key_exists('action',$_POST)){
        if($_POST["action"] == "update"){
            updateSPDX_Doc($_POST["doc_id"], $_POST["document_comment"], $_POST["spdx_version"], $_POST["data_license"]);
            updateCreator($_POST["doc_id"], $_POST["creator"], $_POST["creator_comments"]);
            updatePackage($_POST["doc_id"], 
                          $_POST["package_name"], 
                          $_POST["package_version"], 
                          $_POST["package_download_location"], 
                          $_POST["package_summary"], 
                          $_POST["package_file_name"],
                          $_POST["package_supplier"],
                          $_POST["package_originator"],
                          $_POST["package_description"],
                          $_POST["package_copyright_text"],
                          $_POST["package_license_concluded"]);
        }
    }
    $doc = mysql_fetch_assoc(getSPDX_Doc($spdxId));
?>
<script>
	$(document).on('click','#edit_doc', function() {
		$('.edit').show();
		$('.view').hide();
	});
</script>
<div class="container">
	<?php 
		if(array_key_exists('action',$_POST)) {
        	if($_POST["action"] == "update") {
				echo '<div align="center"><h4><p class="text-success">Successfully Updated Document</p></h4></div>';
        	}
		}
	?>
    <form id="spdx_form" action="spdx_doc.php?doc_id=<?php echo $spdxId; ?>" method="post">
        <input type="hidden" name="action" value="update"/>
        <table id="tblMain" class="table table-bordered table-striped table-doc">
            <thead>
                <tr>
                    <th colspan=2><?php echo $doc["package_name"]; ?>
                    	<div style="display:inline-block;float:right;">
	                        <button id="download_top" type="button"  class="btn btn-primary">Download RDF</button>
	                        <button id="download_top" type="button"  class="btn btn-primary">Download TAG</button>
	                        <button id="edit_doc"     type="button"  class="btn btn-primary view"/>Edit</button>
	                        <button id="save_doc"     type="submit"  class="btn btn-primary edit" style="display:none;">Save</button>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Version</td>
                    <td class="edit" style="display:none;">
                        <textarea name="spdx_version" class='form-control'><?php echo $doc["spdx_version"]; ?></textarea>
                       </td>
                    <td class="view"><?php echo $doc["spdx_version"]; ?></td>
                </tr>
                <tr>
                    <td>Data License</td>
                    <td class="edit" style="display:none;">
                        <textarea name="data_license" class='form-control'><?php echo $doc["data_license"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["data_license"]; ?></td>
                </tr>
                <tr>
                    <td>Document Comment</td>
                    <td class="edit" style="display:none;">
                        <textarea name="document_comment"  class='form-control'><?php echo $doc["document_comment"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["document_comment"]; ?></td>
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
                    <td class="edit" style="display:none;">
                        <textarea name="creator" class='form-control'><?php echo $doc["creator"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["creator"]; ?></td>
                </tr>
                <tr>
                    <td>Created</td>
                    <td><?php echo date('d/j/o', strtotime($doc["created_at"])); ?></td>
                </tr>
                <tr>
                    <td>Updated</td>
                    <td><?php echo date('d/j/o', strtotime($doc["updated_at"])); ?></td>
                </tr>
                <tr>
                    <td>Creator Comment</td>
                    <td class="edit" style="display:none;">
                        <textarea name="creator_comments" class='form-control'><?php echo $doc["creator_comments"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["creator_comments"]; ?></td>
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
                    <td class="edit" style="display:none;">
                        <textarea name="package_name" class='form-control'><?php echo $doc["package_name"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_name"]; ?></td>
                </tr>
                <tr>
                    <td>Package Version</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_version" class='form-control'><?php echo $doc["package_version"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_version"]; ?></td>
                </tr>
                <tr>
                    <td>Package Download Location</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_download_location" class='form-control'><?php echo $doc["package_download_location"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_download_location"]; ?></td>
                </tr>
                <tr>
                    <td>Package Summary</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_summary" class='form-control'><?php echo $doc["package_summary"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_summary"]; ?></td>
                </tr>
                <tr>
                    <td>Package File Name</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_file_name" class='form-control'><?php echo $doc["package_file_name"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_file_name"]; ?></td>
                </tr>
                <tr>
                    <td>Package Supplier</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_supplier" class='form-control'><?php echo $doc["package_supplier"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_supplier"]; ?></td>
                </tr>
                <tr>
                    <td>Package Originator</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_originator" class='form-control'><?php echo $doc["package_originator"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_originator"]; ?></td>
                </tr>
                <tr>
                    <td>Package Checksum</td>
                    <td><?php echo $doc["package_checksum"]; ?></td>
                </tr>
                <tr>
                    <td>Package Verification Code</td>
                    <td><?php echo $doc["package_verification_code"]; ?></td>
                </tr>
                <tr>
                    <td>Package Description</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_description" class='form-control'><?php echo $doc["package_description"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_description"]; ?></td>
                </tr>
                <tr>
                    <td>Package Copyright Text</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_copyright_text" class='form-control'><?php echo $doc["package_copyright_text"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_copyright_text"]; ?></td>
                </tr>
                <tr>
                    <td>License Declared</td>
                    <td><?php echo $doc["package_license_declared"]; ?></td>
                </tr>
                <tr>
                    <td>Package License Concluded</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_license_concluded" class='form-control'><?php echo $doc["package_license_concluded"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_license_concluded"]; ?></td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th colspan=2>Files</th>
                </tr>
            </thead>
            <tbody>
	                <?php
	                    $files = getPackageFiles($spdxId);
	                    while($row = mysql_fetch_assoc($files)) {
							echo '<tr>';
							echo 	'<td>' . $row['relative_path'] . '</td>';
							echo 	'<td><a href="file.php?file_id=' . $row['id'] . '">View File Details</a></td>';
							echo '</tr>';
						}
	                ?>
            </tbody>
        </table>
    </form>
</div>
<?php
    incFooter();
?>