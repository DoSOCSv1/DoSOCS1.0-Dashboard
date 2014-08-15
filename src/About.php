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
    incHeader("About");
?>
<script type="text/javascript">
    function filter (term, _id, cellNr) {
        var suche = term.value.toLowerCase();
        var table = document.getElementById(_id);
        var ele;
        for (var r = 0; r < table.rows.length; r++) {
            ele = table.rows[r].cells[cellNr].innerHTML.replace(/<[^>]+>/g,"");
            if (ele.toLowerCase().indexOf(suche)>=0 ) {
                table.rows[r].style.display = '';
            }
            else {
                table.rows[r].style.display = 'none';
            }
        }
    }
    function hideCol(col) {
        if(col == 1) {
            document.getElementById("save_top").style.display="none";
            document.getElementById("save_bottom").style.display="none";
        }
        else {
            document.getElementById("save_top").style.display="";
            document.getElementById("save_bottom").style.display="";
            document.getElementById("edit_doc").style.display="none";
        }
        var tbl = document.getElementById("tblMain");
        for (var i = 1; i < tbl.rows.length; i++) {
            for (var j = 0; j < tbl.rows[i].cells.length; j++) {
                tbl.rows[i].cells[j].style.display = "";
                if(tbl.rows[i].cells[j].innerHTML == 'File Name') {
                    return;
                }
                if (j == col) {
                    tbl.rows[i].cells[j].style.display = "none";
                }
            }
        }
    }
</script>
<div class="container">
    <p>
        FOSSology+SPDX aims to support the advancement of tooling to produce SPDX documents from the FOSSology open source package scanner. 
        This tool supports the integration of the SPDX standard into current license scanning practices. 
        SPDX or The Software Package Data Exchange specification is a standard format for communicating the components, licenses and copyrights associated with a software package (http://spdx.org/ 2014). 
        FOSSology is a source code scanning tool used to identify license and copyright.
    </p>
    <p>
        The University of Nebraska at Omaha Open Systems development class is currently creating other tools to facilitate the use of SPDX documents for the business setting. 
        These tools include a web based dashboard to view SPDX documents in a more user friendly way. 
        Another tool the class has been developing is the SPDX Product History Utility, which will allow business to associate products with software packages in order to inventory which software licenses and copyrights are on their products.
    </p>
</div>
<?php
    incFooter();
?>