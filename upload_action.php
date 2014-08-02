<?php
    $filePath                   = $_FILES["package"]["tmp_name"];
    $fileName                   = $_FILES["package"]["name"];
    $document_comment          = $_POST['document_comment'];
    $creator                    = $_POST['creator'];
    $creator_comment           = $_POST['creator_comment'];
    $pakage_version            = $_POST['pacakge_version'];
    $package_supplier          = $_POST['package_supplier'];
    $package_originator        = $_POST['package_originator'];
    $package_download_location = $_POST['package_download_location'];
    $package_home_page           = $_POST['package_home_page'];
    $package_source_info        = $_POST['package_source_info'];
    $package_license_comments  = $_POST['package_license_comments'];
    $package_description       = $_POST['package_description'];

    move_uploaded_file($filePath,"/uploads/$fileName");
    $commandLine = "/do_spdx/DoSPDX.py --scan --packagePath \"/uploads/$fileName\"";
    if(!empty($document_comment)) {
        $commandLine .= " --documentComment \"$document_comment\"";
    }
    if(!empty($creator)) {
        $commandLine .= " --creator \"$creator\"";
    }
    if(!empty($creator_comment)) {
        $commandLine .= " --creatorComment \"$creator_comment\"";
    }
    if(!empty($pakage_version)) {
        $commandLine .= " --packageVersion \"$pakage_version\"";
    }
    if(!empty($package_supplier)) {
        $commandLine .= " --packageSupplier \"$package_supplier\"";
    }
    if(!empty($package_originator)) {
        $commandLine .= " --packageOriginator \"$package_originator\"";
    }
    if(!empty($package_download_location)) {
        $commandLine .= " --packageDownloadLocation \"$package_download_location\"";
    }
    if(!empty($package_home_page)) {
        $commandLine .= " --packageHomePage \"$package_home_page\"";
    }
    if(!empty($package_source_info)) {
        $commandLine .= " --packageSourceInfo \"$package_source_info\"";
    }
    if(!empty($package_license_comments)) {
        $commandLine .= " --packageLicenseComments \"$package_license_comments\"";
    }
    if(!empty($package_description)) {
        $commandLine .= " --documentComment \"$package_description\"";
    }

    exec($commandLine);
    echo "Package uploaded successfully."
?>