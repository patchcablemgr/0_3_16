<?php

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	
	// Write out the subject ID (objID, templateID, or nodeID)
	if(isset($_GET['objID'])) {
		$objID = $_GET['objID'];
		echo '<input id="objID" type="hidden" value="'.$objID.'">';
	}
	
	if(isset($_GET['objFace'])) {
		$objFace = $_GET['objFace'];
		echo '<input id="objFace" type="hidden" value="'.$objFace.'">';
	}
	
	if(isset($_GET['objDepth'])) {
		$objDepth = $_GET['objDepth'];
		echo '<input id="objDepth" type="hidden" value="'.$objDepth.'">';
	}
	
	if(isset($_GET['portID'])) {
		$portID = $_GET['portID'];
		echo '<input id="portID" type="hidden" value="'.$portID.'">';
	}
	
	if(isset($_GET['parentID'])) {
		$parentID = $_GET['parentID'];
		echo '<input id="parentID" type="hidden" value="'.$parentID.'">';
	}
	
	if(isset($_GET['parentFace'])) {
		$parentFace = $_GET['parentFace'];
		echo '<input id="parentFace" type="hidden" value="'.$parentFace.'">';
	}
	
	if(isset($_GET['templateID'])) {
		$templateID = $_GET['templateID'];
		echo '<input id="templateID" type="hidden" value="'.$templateID.'">';
	}
	
	if(isset($_GET['nodeID'])) {
		$nodeID = $_GET['nodeID'];
		echo '<input id="nodeID" type="hidden" value="'.$nodeID.'">';
	}
	
}

?>