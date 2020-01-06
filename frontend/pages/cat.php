<?php
global $cats;

if(isset($_REQUEST['catid'])) $id = $_REQUEST['catid'];
else $id = 0;

$cats->getCategory($id);
?>