<?php 
    $spdxDocId = $_GET['doc_id'];
    $format    = $_GET['format'];
    $spdxName  = $_GET['doc_name'];
    
    $printFormat = "TAG";
    if($format == "RDF") {
        $printFormat = "RDF";
    }
    
    $commandLine = $commandLine = "/do_spdx/DoSPDX.py --print $printFormat --spdxDocId $spdxDocId";
    exec($commandLine,$result);
    
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$spdxName.spdx");
    header("Content-Type: application/octet-stream; ");
    header("Content-Transfer-Encoding: binary");
    foreach($result as $line) {
        echo $line;
    }
?>