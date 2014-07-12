<?php
    include("function/headerfooter.php");
    incHeader("SPDX");
?>
    <div class="container">
        <!-- Placeholder for dashboard views -->
        <?php 
            if(array_key_exists('doc_id',$_GET)) {
                include 'spdx_docview.php';
            }
            else {
                include 'spdx_listview.php';
            }
        ?>
    </div>
<?php
    incFooter();
?>
