<?php
    include("function/headerfooter.php");
    incHeader("Upload Package");
?>
<div class="col-md-8 col-md-offset-2">
    <form action="upload_action.php" method="POST" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="packageFile">Package</label>
            <input type="file" name="package" id="filePackageFile"/>
        </div>
        <div class="form-group">
            <label for="txtDocComment">Document Comment</label>
            <textarea name="document_comment" id="txtDocumentComment" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="">Creator</label>
            <input type="text" name="creator" id="txtCreator" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="txtAreaCreatorComment">Creator Comment</label>
            <textarea id="txtAreaCreatorComment" name="creator_comment" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="packageVersion">Package Version</label>
            <input type="text" name="pacakge_version" id="txtPackageVersion" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="txtPackageSupplier">Package Supplier</label>
            <input type="text" name="package_supplier" id="txtPackageSupplier" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="txtPackageOriginator">Package Originator</label>
            <input type="text" id="txtPackageOriginator" name="package_originator" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="txtPackageDownalodLocation">Package Download Location</label>
            <input type="text" id="txtPackageDownalodLocation" name="package_download_location" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="txtPackageHomePage">Package Home Page</label>
            <input type="text" id="txtPackageHomePage" name="package_home_page" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="txtPackageSourceInfo">Package Source Info</label>
            <input type="text" id="txtPackageSourceInfo" name="package_source_info" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="txtPackageLicenseComments">Package License Comments</label>
            <input type="text" id="txtPackageLicenseComments" name="package_license_comments" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="txtPackageDescription">Package Description</label>
            <input type="text" id="txtPackageDescription" name="package_description" class="form-control"/>
        </div>
        <input type="submit" value="submit">
    </form>
</div>
<?php
    incFooter(); 
?>