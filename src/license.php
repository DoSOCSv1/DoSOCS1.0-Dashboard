<?php
    include("function/headerfooter.php");
    include("function/license.php");
    
    $licenseId = $_GET['license_id'];
    $spdxId    = $_GET['doc_id'];
    
    incHeader("License");
    if(array_key_exists('action',$_POST)){
        if($_POST["action"] == "update"){
            updateLicenses($licenseId,
                           $spdxId,
                           $_POST['extracted_text'],
                           $_POST['osi_approved'],
                           $_POST['license_cross_reference'],
                           $_POST['license_comments']);
        }
    }
    $lic = mysql_fetch_assoc(getlicenseInfo($spdxId,$licenseId));
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
                echo '<div align="center"><h4><p class="text-success">Successfully Updated License</p></h4></div>';
            }
        }
    ?>
    <form id="spdx_form" action="license.php?license_id=<?php echo $licenseId; ?>&doc_id=<?php echo $spdxId;?>" method="post">
        <input type="hidden" name="action" value="update"/>
        <table id="tblMain" class="table table-bordered table-striped table-doc">
            <thead>
                <tr>
                    <th colspan=2>
                        <?php echo $lic["license_name"]; ?>
                        <div style="display:inline-block;float:right;">
                            <button id="edit_doc"     type="button"  class="btn btn-primary view"/>Edit</button>
                            <button id="save_doc"     type="submit"  class="btn btn-primary edit" style="display:none;">Save</button>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td title="License Identifier for this license in this SPDX document.">License Identifier</td>
                    <td><?php echo $lic["license_identifier"]; ?></td>
                </tr>
                <tr>
                    <td title="Any addtional information on this license in this SPDX document.">License Comments</td>
                    <td class="edit" style="display:none;">
                        <textarea name="license_comments" class='form-control'><?php echo $lic["license_comments"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $lic["license_comments"]; ?></td>
                </tr>
                <tr>
                    <td title="Provide a pointer to the official source of a license that is not included in the SPDX License List.">License Cross Reference</td>
                    <td class="edit" style="display:none;">
                        <textarea name="license_cross_reference" class='form-control'><?php echo $lic["license_cross_reference"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $lic["license_cross_reference"]; ?></td>
                </tr>
                <tr>
                    <td title="Any addtional information on this license in this SPDX document.">OSI Approved</td>
                    <td class="edit" style="display:none;">
                        <textarea name="osi_approved" class='form-control'><?php echo $lic["osi_approved"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $lic["license_comments"]; ?></td>
                </tr>
                <tr>
                    <td title="File this license was identified in.">File</td>
                    <td><a href="file.php?file_id=<?php echo $lic['file_id'];?>&doc_id=<?php echo $spdxId; ?>"><?php echo $lic["file_name"]; ?></a></td>
                </tr>
                <tr>
                    <td title="Text that identified the license in the file.">Extracted Text</td>
                    <td class="edit" style="display:none;">
                        <textarea name="extracted_text" class='form-control'><?php echo $lic["extracted_text"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $lic["extracted_text"]; ?></td>
                </tr>
                <tr>
                    <td title="Date this license was added to this SPDX document.">Created At</td>
                    <td><?php echo $lic["created_at"]; ?></td>
                </tr>
                <tr>
                    <td title="Date this license was last updated.">Updated At</td>
                    <td><?php echo $lic["updated_at"]; ?></td>
                </tr>
            </tbody>
        </table>
    </form>
    <div align="center">
    	<a href="spdx_doc.php?doc_id=<?php echo $spdxId; ?>">Back to Document</a>
    </div>
</div>
<?php
    incFooter();
?>