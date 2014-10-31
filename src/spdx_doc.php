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
    include("function/headerfooter.php");
    include("function/spdx_doc.php");
    include("function/creator.php");
    include("function/package.php");
    include("function/package_files.php");
    include("function/license.php");
    include("function/tree.php");
    incHeader("SPDX");
    
    $spdxId = $_GET["doc_id"];
    if(array_key_exists('action',$_POST)){
        if($_POST["action"] == "update"){
            updateSPDX_Doc($spdxId, $_POST["document_comment"], $_POST["spdx_version"], $_POST["data_license"]);
            updateCreator($spdxId, $_POST["creator"], $_POST["creator_comments"]);
            updatePackage($spdxId, 
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
<style>
    a.tooltip {outline:none; }
    a.tooltip strong {line-height:30px;}
    a.tooltip:hover {text-decoration:none;} 
    a.tooltip span {
        z-index:10;display:none; padding:14px 20px;
        margin-top:-30px; margin-left:28px;
        width:240px; line-height:16px;
    }
    a.tooltip:hover span{
        display:inline; position:absolute; color:#111;
        border:1px solid #DCA; background:#fffAF0;}
    .callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}
        
    /*CSS3 extras*/
    a.tooltip span
    {
        border-radius:4px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
            
        -moz-box-shadow: 5px 5px 8px #CCC;
        -webkit-box-shadow: 5px 5px 8px #CCC;
        box-shadow: 5px 5px 8px #CCC;
    }
</style>
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
                            <button id="download_top" type="button"  class="btn btn-primary" onclick="window.open('download.php?doc_id=<?php echo $spdxId; ?>&format=RDF&doc_name=<?php echo $doc["package_name"];?>','_blank');">Download RDF</button>
                            <button id="download_top" type="button"  class="btn btn-primary" onclick="window.open('download.php?doc_id=<?php echo $spdxId; ?>&format=TAG&doc_name=<?php echo $doc["package_name"];?>','_blank');">Download TAG</button>
                            <button id="download_top" type="button"  class="btn btn-primary" onclick="window.open('download.php?doc_id=<?php echo $spdxId; ?>&format=JSON&doc_name=<?php echo $doc["package_name"];?>','_blank');">Download JSON</button>
                            <button id="edit_doc"     type="button"  class="btn btn-primary view"/>Edit</button>
                            <button id="save_doc"     type="submit"  class="btn btn-primary edit" style="display:none;">Save</button>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td title="Version of the SPDX spcification used to create this document.">Version</td>
                    <td class="edit" style="display:none;">
                        <textarea name="spdx_version" class='form-control'><?php echo $doc["spdx_version"]; ?></textarea>
                       </td>
                    <td class="view"><?php echo $doc["spdx_version"]; ?></td>
                </tr>
                <tr>
                    <td title="License of the content within this SPDX document.">Data License</td>
                    <td class="edit" style="display:none;">
                        <textarea name="data_license" class='form-control'><?php echo $doc["data_license"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["data_license"]; ?></td>
                </tr>
                <tr>
                    <td title="Additional comments for this SPDX document.">Document Comment</td>
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
                    <td title="Who created this SPDX document.">Creator</td>
                    <td class="edit" style="display:none;">
                        <textarea name="creator" class='form-control'><?php echo $doc["creator"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["creator"]; ?></td>
                </tr>
                <tr>
                    <td title="When was this SPDX document created.">Created</td>
                    <td><?php echo date('d/j/o', strtotime($doc["created_at"])); ?></td>
                </tr>
                <tr>
                    <td title="When was this document last updated.">Updated</td>
                    <td><?php echo date('d/j/o', strtotime($doc["updated_at"])); ?></td>
                </tr>
                <tr>
                    <td title="Additional comments from during the creation of this document.">Creator Comment</td>
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
                    <td title="Name of the package this SPDX document was created for.">Package Name</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_name" class='form-control'><?php echo $doc["package_name"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_name"]; ?></td>
                </tr>
                <tr>
                    <td title="Version number of the package this SPDX document was created for.">Package Version</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_version" class='form-control'><?php echo $doc["package_version"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_version"]; ?></td>
                </tr>
                <tr>
                    <td title="Where this package was downloaded from (URL).">Package Download Location</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_download_location" class='form-control'><?php echo $doc["package_download_location"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_download_location"]; ?></td>
                </tr>
                <tr>
                    <td title="This field is a short description of the package.">Package Summary</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_summary" class='form-control'><?php echo $doc["package_summary"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_summary"]; ?></td>
                </tr>
                <tr>
                    <td title="Name of the file that contains this package.">Package File Name</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_file_name" class='form-control'><?php echo $doc["package_file_name"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_file_name"]; ?></td>
                </tr>
                <tr>
                    <td title="Original source of this package.">Package Supplier</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_supplier" class='form-control'><?php echo $doc["package_supplier"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_supplier"]; ?></td>
                </tr>
                <tr>
                    <td title="If this SPDX document came from a different source, what was that source.">Package Originator</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_originator" class='form-control'><?php echo $doc["package_originator"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_originator"]; ?></td>
                </tr>
                <tr>
                    <td title="Unique identifier for the original package archive file.">Package Checksum</td>
                    <td><?php echo $doc["package_checksum"]; ?></td>
                </tr>
                <tr>
                    <td title="Unique identifier for the package as a whole.">Package Verification Code</td>
                    <td><?php echo $doc["package_verification_code"]; ?></td>
                </tr>
                <tr>
                    <td title="Short description of the package.">Package Description</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_description" class='form-control'><?php echo $doc["package_description"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_description"]; ?></td>
                </tr>
                <tr>
                    <td title="Any text related to a copyright notice within this package.">Package Copyright Text</td>
                    <td class="edit" style="display:none;">
                        <textarea name="package_copyright_text" class='form-control'><?php echo $doc["package_copyright_text"]; ?></textarea>
                    </td>
                    <td class="view"><?php echo $doc["package_copyright_text"]; ?></td>
                </tr>
                <tr>
                    <td title="License declared by the authors of this package.">License Declared</td>
                    <td><?php echo $doc["package_license_declared"]; ?></td>
                </tr>
                <tr>
                    <td title="The governing license of this package.">Package License Concluded</td>
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
                    <tr>
            <td colspan=2>
                    <?php
                        $files = getPackageFiles($spdxId);
                        $all_files = array();
                        while($row = mysql_fetch_assoc($files)) {
                            $all_files[$row['relative_path']]=$row['id'];
                        }
                        
                        $mAllTrees = array();
    
                       foreach($all_files as $file=> $fileId){
                            if(strpos($file,'/') != FALSE){
                               $path = substr($file,0,strrpos($file,'/'));
                               $fileName = substr($file,strrpos($file,'/')+1);
                               $root = substr($file,0,strpos($file,'/'));
                               
                               if(array_key_exists($root,$mAllTrees))
                                    $tree = $mAllTrees[$root];
                                else{
                                    $tree = new Tree();
                                    $tree->setSpdxId($spdxId);
                                    $mAllTrees[$root] = $tree;
                                }
                                   
                                                
                               if($tree->hasPath($path)){
                                  $tree->addFileToPath($path,$fileName.' - <a href="file.php?file_id=' . $all_files[$file]. '&doc_id=' . $spdxId . '">View File Details</a>',$all_files[$file]);
                               }
                               else{
                                  $tree->createPath($path);
                                  $tree->addFileToPath($path,$fileName.' - <a href="file.php?file_id=' . $all_files[$file]. '&doc_id=' . $spdxId . '">View File Details</a>',$all_files[$file]);
                               }
                            }
                            else{
                                $tree = new Tree();
                                $tree->setSpdxId($spdxId);
                                $tree->createNode($file.' - <a href="file.php?file_id=' . $all_files[$file]. '&doc_id=' . $spdxId . '">View File Details</a>',null);
                                $tree->addFieldId($file,$all_files[$file]);
                                //$tree->addFileToPath($fileName,$fileName,20);
                                $mAllTrees[$file] = $tree;
                            }
                       }
                       
                       if(count($mAllTrees) > 0){
                          $html = '';
                          $html = $html.'<div class="tree"><ul>';
                          foreach($mAllTrees as $root => $iTree){
                            //$html = $html.$iTree->printTree($iTree->getRoot(),0);
                            
                            $html = $html.$iTree->printTreeNew($iTree->getRoot());
                            
                          }
                          $html = $html.'</ul></div>';
                          echo $html;
                       }
   
                        ?>
                    <td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th colspan=2>Licenses</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $licenses = getDocLicenses($spdxId);
                        while($row = mysql_fetch_assoc($licenses)) {
                            echo '<tr>';
                            echo     '<td>' . $row['license_identifier'] . '</td>';
                            echo     '<td><a href="license.php?license_id=' . $row['license_id'] . '&doc_id=' . $spdxId . '">View License Details</a></td>';
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
