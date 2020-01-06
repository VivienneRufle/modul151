<?php
if(isset($_REQUEST['fid'])) $fid = $_REQUEST['fid'];
else $fid = 0;

global $cats;

$cats->getBoard($fid);
?>