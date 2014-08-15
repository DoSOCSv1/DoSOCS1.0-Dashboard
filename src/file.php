<SPDX-License-Identifier: Apache-2.0>
<!--
Copyright 2014 Zac McFarland

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
    include("function/package_files.php");
    
    $fileId = $_GET['file_id'];
    $spdxDocId = $_GET['doc_id'];
    
    incHeader("File");
    if(array_key_exists('action',$_POST)){
        if($_POST["action"] == "update"){
            updateFile($fileId,
                       $_POST["file_copyright_text"],
                       $_POST["artifact_of_project_name"],
                       $_POST["artifact_of_project_homepage"],
                       $_POST["artifact_of_project_uri"],
                       $_POST["license_concluded"],
                       $_POST["license_info_in_file"],
                       $_POST["license_comments"],
                       $_POST["file_notice"],
                       $_POST["file_contributor"],
                       $_POST["file_dependency"],
                       $_POST["file_comment"]);
        }
    }
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
    <form id="spdx_form" action="file.php?file_id=<?php echo $fileId; ?>&doc_id=<?php echo $spdxDocId;?>" method="post">
        <input type="hidden" name="action" value="update"/>
        <table id="tblMain" class="table table-bordered table-striped table-doc">
            <thead>
                <tr>
                    <th colspan=2>
	                    <?php echo $file["file_name"]; ?>
	                    <div style="display:inline-block;float:right;">
	                        <button id="edit_doc"     type="button"  class="btn btn-primary view"/>Edit</button>
	                        <button id="save_doc"     type="submit"  class="btn btn-primary edit" style="display:none;">Save</button>
	                    </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td title="Type of this file.">File Type</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_copyright_text" class='form-control'><?php echo $file["file_copyright_text"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_copyright_text"]; ?></td>
                </tr>
                <tr>
                    <td title="Project the file has been derived from.">Artifact Of Project Name</td>
                    <td class="edit" style="display:none;">
                        <textarea name="artifact_of_project_name" class='form-control'><?php echo $file["artifact_of_project_name"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["artifact_of_project_name"]; ?></td>
                </tr>
                <tr>
                    <td title="Location of project from which this file has been derived.">Artifact Of Project Homepage</td>
                    <td class="edit" style="display:none;">
                        <textarea name="artifact_of_project_homepage" class='form-control'><?php echo $file["artifact_of_project_homepage"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["artifact_of_project_homepage"]; ?></td>
                </tr>
                <tr>
                    <td title="Link to the project from which this file was derived.">Artifact Of Project URI</td>
                    <td class="edit" style="display:none;">
                        <textarea name="artifact_of_project_uri" class='form-control'><?php echo $file["artifact_of_project_uri"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["artifact_of_project_uri"]; ?></td>
                </tr>
                <tr>
                    <td title="License governing this file.">License Concluded</td>
                    <td class="edit" style="display:none;">
                        <textarea name="license_concluded" class='form-control'><?php echo $file["license_concluded"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["license_concluded"]; ?></td>
                </tr>
                <tr>
                    <td title="Any text found in this file pertaining to the license.">License Info In File</td>
                    <td class="edit" style="display:none;">
                        <textarea name="license_info_in_file" class='form-control'><?php echo $file["license_info_in_file"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["license_info_in_file"]; ?></td>
                </tr>
                <tr>
                    <td title="Unique identifier of this file.">File Checksum</td>
                    <td><?php echo $file["file_checksum"]; ?></td>
                </tr>
                <tr>
                    <td tilte="Algorigthm used to calulate the checksum of this file.">File Checksum Algorithm</td>
                    <td><?php echo $file["file_checksum_algorithm"]; ?></td>
                </tr>
                <tr>
                    <td title="Path to this file relative to the root of the pacakge file.">Relative Path</td>
                    <td><?php echo $file["relative_path"]; ?></td>
                </tr>
                <tr>
                    <td title="Any relevant additional license information for this file.">License Comments</td>
                    <td class="edit" style="display:none;">
                        <textarea name="license_comments" class='form-control'><?php echo $file["license_comments"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["license_comments"]; ?></td>
                </tr>
                <tr>
                    <td title="Any legal notices found in this file.">File Notice</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_notice" class='form-control'><?php echo $file["file_notice"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_notice"]; ?></td>
                </tr>
                <tr>
                    <td title="Anyone who has contributed to this file.">File Contributor</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_contributor" class='form-control'><?php echo $file["file_contributor"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_contributor"]; ?></td>
                </tr>
                <tr>
                    <td title="References to any files, whithin this package, that this file depends upon.">File Dependency</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_dependency" class='form-control'><?php echo $file["file_dependency"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_dependency"]; ?></td>
                </tr>
                <tr>
                    <td title="General comments about this file">File Comment</td>
                    <td class="edit" style="display:none;">
                        <textarea name="file_comment" class='form-control'><?php echo $file["file_comment"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $file["file_comment"]; ?></td>
                </tr>
                <tr>
                    <td title="License of this file.">License</td>
                    <td><a href="license.php?license_id=<?php echo $file['license_id'];?>&doc_id=<?php echo $spdxDocId; ?>"><?php echo $file["license_identifier"]; ?></a></td>
                </tr>
                <tr>
                    <td title="Date this file was added to this SPDX document.">Created On</td>
                    <td><?php echo date('d/j/o', strtotime($file["created_at"])); ?></td>
                </tr>
                <tr>
                    <td title="Date this file information  was last updated.">Updated On</td>
                    <td><?php echo date('d/j/o', strtotime($file["updated_at"]));; ?></td>
                </tr>
            </tbody>
        </table>
    </form>
    <div align="center">
    	<a href="spdx_doc.php?doc_id=<?php echo $spdxDocId; ?>">Back to Document</a>
    </div>
</div>
<?php
    incFooter();
?>
