<?php 
    function getPackageFiles($spdx_doc_id) {
        //Create Database connection
        include("Data_Source.php");
        mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
        mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());

        //Query
        $sql  = "SELECT DISTINCT pf.*,
                                 LENGTH( pf.relative_path ) - LENGTH( REPLACE( pf.relative_path,  '/',  '' ) ) AS level,
                                 dfpa.package_id
                 FROM package_files pf
                       INNER JOIN doc_file_package_associations dfpa ON pf.id = dfpa.package_file_id
                 WHERE dfpa.spdx_doc_id = " . $spdx_doc_id;
        
        //Execute Query
        $qryPKGFiles = mysql_query($sql);
        
        //Close Connection
        mysql_close();
        
        return $qryPKGFiles;
    }
    
    function getPackageFile($fileId) {
        //Create Database connection
        include("Data_Source.php");
        mysql_connect("$host", "$username", "$password")or die("cannot connect server " . mysql_error());
        mysql_select_db("$db_name")or die("cannot select DB " . mysql_error());
        
        //Query
        $sql  = "SELECT Id,
                        file_name,
                        file_type,
                        file_copyright_text,
                        artifact_of_project_name,
                        artifact_of_project_homepage,
                        artifact_of_project_uri,
                        license_concluded,
                        license_info_in_file,
                        file_checksum,
                        file_checksum_algorithm,
                        relative_path,
                        license_comments,
                        file_notice,
                        file_contributor,
                        file_dependency,
                        file_comment,
                        created_at,
                        updated_at
                FROM package_files
                WHERE Id = " . $fileId;
        
        //Execute Query
        $qryPKGFile = mysql_query($sql);
        
        //Close Connection
        mysql_close();
        
        return $qryPKGFile;
    }
?>