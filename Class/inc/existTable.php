<?php

function existTable($tbl) {
	
	$configs = include('datadb.php');

	$conn = new mysqli($configs['host'],$configs['username'],$configs['pass'],"information_schema");
    $sql = 'SELECT TABLE_NAME FROM TABLES WHERE TABLE_NAME = ? AND TABLE_SCHEMA = ?';
    if (!$stmt = $conn->prepare($sql)) {
        return false;
    }
	$tbls = $configs['db'];
    $stmt->bind_param('ss', $tbl, $tbls);
    $stmt->execute();
    $stmt->bind_result($bla);
    if ($stmt->fetch()) {
        return true;
    } else {
        return false;
    }
}

?>