<?php 

require_once '../../Model/admin/adminModel.php';
$checks = new Admin();
$checksData = $checks->selectChecks();