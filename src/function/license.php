<SPDX-License-Identifier: Apache-2.0>
<!--
Copyright (C) 2014 University of Nebraska at Omaha.

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
    function getDocLicenses($spdx_doc_id) {
        //Create Database connection
        include("Data_Source.php");
        mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
        mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());
        
        //Query
        $sql  = "SELECT dla.Id,
                        dla.spdx_doc_id,
                        dla.license_id,
                        dla.license_identifier,
                        dla.license_name,
                        dla.license_comments,
                        dla.created_at,
                        dla.updated_at
                FROM doc_license_associations AS dla
                WHERE dla.spdx_doc_id = " . $spdx_doc_id;
        
        //Execute Query
        $qryDocLicenses = mysql_query($sql);
        
        //Close Connection
        mysql_close();
        
        return $qryDocLicenses;
    }
    
    function getLicenseInfo($spdx_doc_id, $license_id) {
        //Create Database connection
        include("Data_Source.php");
        mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
        mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());
        
        //Query
        $sql  = "SELECT dla.Id,
                        dla.spdx_doc_id,
                        dla.license_id,
                        dla.license_identifier,
                        dla.license_name,
                        dla.license_comments,
                        dla.created_at,
                        dla.updated_at,
                        pf.file_name,
                        pf.Id AS file_id,
                        l.extracted_text,
                        l.osi_approved,
                        l.standard_license_header,
                        l.license_cross_reference
                FROM doc_license_associations AS dla
                     LEFT OUTER JOIN licensings AS ls ON dla.Id = ls.doc_license_association_id
                     LEFT OUTER JOIN package_files AS pf ON ls.package_file_id = pf.Id
                     LEFT OUTER JOIN licenses AS l ON dla.license_id = l.Id
                WHERE dla.spdx_doc_id = " . $spdx_doc_id . "
                      AND dla.license_id = " . $license_id;
        
        //Execute Query
        $qryLicenseInfo = mysql_query($sql);
        
        //Close Connection
        mysql_close();
        
        return $qryLicenseInfo;
    }
    
    function updateLicenses($license_id, $spdxId, $extracted_text = "", $osi_approved = "", $license_cross_reference = "", $license_comments = "") {
        //Create Database connection
        include("Data_Source.php");
        mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
        mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());
        
        //Query
        $sql  = "UPDATE licenses 
                 SET extracted_text = '" . $extracted_text . "',
                      osi_approved = '" . $osi_approved . "',
                      license_cross_reference = '" . $license_cross_reference . "'
                 WHERE Id = " . $license_id;
                 
                 
        
        //Execute Query
        $updLicenseInfo = mysql_query($sql);
        
        $sql = "UPDATE doc_license_associations
                 SET license_comments = '" . $license_comments . "' 
                 WHERE spdx_doc_id = " . $spdxId . " 
                        AND license_id = " . $license_id;
        
        $updLicenseAssoc = mysql_query($sql);        
        
        //Close Connection
        mysql_close();
        
        return $updLicenseAssoc;
    }
?>
