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
    function getSPDX_Doc($spdx_doc_id) {
        //Create Database connection
        include("Data_Source.php");
        mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
        mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());

        //Query
        $query = "SELECT sd.id
                        ,sd.spdx_version
                        ,sd.data_license
                        ,sd.document_comment
                        ,sd.updated_at
                        ,c.creator
                        ,c.created_at
                        ,c.creator_comments
                        ,p.package_name
                        ,p.package_version
                        ,p.package_download_location
                        ,p.package_summary
                        ,p.package_file_name
                        ,p.package_supplier
                        ,p.package_originator
                        ,p.package_checksum
                        ,p.package_verification_code
                        ,p.package_description
                        ,p.package_copyright_text
                        ,p.package_license_declared
                        ,p.package_license_concluded

                 FROM spdx_docs sd
                      LEFT OUTER JOIN creators c ON sd.id = c.spdx_doc_id
                      LEFT OUTER JOIN doc_file_package_associations dfpa ON sd.id = dfpa.spdx_doc_id
                      LEFT OUTER JOIN packages p ON dfpa.package_id = p.id

                WHERE sd.id = " . $spdx_doc_id . "

                GROUP BY sd.id
                        ,sd.spdx_version
                        ,sd.data_license
                        ,sd.document_comment
                        ,sd.updated_at
                        ,c.creator
                        ,c.created_at
                        ,c.creator_comments
                        ,p.package_name
                        ,p.package_version
                        ,p.package_download_location
                        ,p.package_summary
                        ,p.package_file_name
                        ,p.package_supplier
                        ,p.package_originator
                        ,p.package_checksum
                        ,p.package_verification_code
                        ,p.package_description
                        ,p.package_copyright_text
                        ,p.package_license_declared
                        ,p.package_license_concluded";
        
        //Execute Query
        $qrySPDX_Doc = mysql_query($query);
        
        //Close Connection
        mysql_close();
        
        return $qrySPDX_Doc;
    }

    function getSPDX_DocList($name = "") {
        //Create Database connection
        include("Data_Source.php");
        mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
        mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());

        $query = "SELECT id,
                         upload_file_name,
                         created_at 
                  FROM spdx_docs ";

       	if($name != "") {
       		$query .= "WHERE upload_file_name LIKE '%" . $name . "%' ";
       	}
        $query .= "ORDER BY created_at ASC";

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
        $sql  = "UPDATE spdx_docs 
                SET document_comment= '" . $document_comment . "', 
                    spdx_version = '" . $spdx_version ."', 
                    data_license = '" . $data_license . "', 
                    updated_at = now() 
                WHERE id =" . $spdx_doc_id;

        //Execute Query
        $qryUpdateDoc = mysql_query($sql);

        //Close Connection
        mysql_close();
    } 
?>
