<?php

/* CHANGE PRINTER NAME IF NEEDED */
$printer = fopen("smb://localhost/EPSON_TM_T81III","w");

if($printer){

    /* feed paper */
    fwrite($printer,"\n\n\n");

    /* FULL CUT COMMAND */
    fwrite($printer, chr(29).chr(86).chr(0));

    fclose($printer);
}
?>