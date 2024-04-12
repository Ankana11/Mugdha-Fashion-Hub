<?php
	@session_start();
	if(!isset($_SESSION["adminusername"])){
		header("Location: index.php");
	}
?>