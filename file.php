<?php
    include("function/headerfooter.php");
    include("function/package_files.php");
    
    $fileId = $_GET['file_id'];
    
    incHeader("File");
    
    $file = mysql_fetch_assoc(getPackageFile($fileId));
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
				echo '<div align="center"><h4><p class="text-success">Successfully Updated File</p></h4></div>';
        	}
		}
	?>
    <form id="spdx_form" action="file.php?file_id=<?php echo $fileId; ?>" method="post">
        <input type="hidden" name="action" value="update"/>
        <table id="tblMain" class="table table-bordered table-striped table-doc">
            <thead>
                <tr>
                    <th colspan=2><?php echo $file["file_name"]; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>File Type</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_copyright_text" class='form-control'><?php echo $file["file_copyright_text"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_copyright_text"]; ?></td>
                </tr>
                <tr>
                    <td>Artifact Of Project Name</td>
                    <td class="edit" style="display:none;">
                        <textarea name="artifact_of_project_name" class='form-control'><?php echo $file["artifact_of_project_name"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["artifact_of_project_name"]; ?></td>
                </tr>
                <tr>
                    <td>Artifact Of Project Homepage</td>
                    <td class="edit" style="display:none;">
                        <textarea name="artifact_of_project_homepage" class='form-control'><?php echo $file["artifact_of_project_homepage"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["artifact_of_project_homepage"]; ?></td>
                </tr>
                <tr>
                    <td>Artifact Of Project URI</td>
                    <td class="edit" style="display:none;">
                        <textarea name="artifact_of_project_uri" class='form-control'><?php echo $file["artifact_of_project_uri"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["artifact_of_project_uri"]; ?></td>
                </tr>
                <tr>
                    <td>License Concluded</td>
                    <td class="edit" style="display:none;">
                        <textarea name="license_concluded" class='form-control'><?php echo $file["license_concluded"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["license_concluded"]; ?></td>
                </tr>
                <tr>
                    <td>License Info In File</td>
                    <td class="edit" style="display:none;">
                        <textarea name="license_info_in_file" class='form-control'><?php echo $file["license_info_in_file"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["license_info_in_file"]; ?></td>
                </tr>
                <tr>
                    <td>File Checksum</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_checksum" class='form-control'><?php echo $file["file_checksum"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_checksum"]; ?></td>
                </tr>
                <tr>
                    <td>File Checksum Algorithm</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_checksum_algorithm" class='form-control'><?php echo $file["file_checksum_algorithm"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_checksum_algorithm"]; ?></td>
                </tr>
                <tr>
                	<td>Relative Path</td>
                    <td class="edit" style="display:none;">
                        <textarea name="relative_path" class='form-control'><?php echo $file["relative_path"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["relative_path"]; ?></td>
                </tr>
                <tr>
                	<td>License Comments</td>
                    <td class="edit" style="display:none;">
                        <textarea name="license_comments" class='form-control'><?php echo $file["license_comments"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["license_comments"]; ?></td>
                </tr>
                <tr>
                	<td>File Notice</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_notice" class='form-control'><?php echo $file["file_notice"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_notice"]; ?></td>
                </tr>
                <tr>
                	<td>File Contributor</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_contributor" class='form-control'><?php echo $file["file_contributor"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_contributor"]; ?></td>
                </tr>
                <tr>
                	<td>File Dependency</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_dependency" class='form-control'><?php echo $file["file_dependency"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_dependency"]; ?></td>
                </tr>
                <tr>
                	<td>File Comment</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_comment" class='form-control'><?php echo $file["file_comment"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_comment"]; ?></td>
                </tr>
                <tr>
                	<td>Created On</td>
                    <td><?php echo date('d/j/o', strtotime($file["created_at"])); ?></td>
                </tr>
                <tr>
                	<td>Updated On</td>
                    <td><?php echo date('d/j/o', strtotime($file["updated_at"]));; ?></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<?php
    incFooter();
?>