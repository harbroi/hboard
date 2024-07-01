<?php
	include("connect.php");
	$id = $_POST["id"];
	$status = $_POST["status"];
	$sequence = $_POST["sequence"];
	$new_status = "To Do";
	if($status=="done"){ $new_status = "To Do"; }
	if($status=="done"){ $new_status = "Done"; }
	if($status=="inqa"){ $new_status = "In QA"; }
	if($status=="inprogress"){ $new_status = "In Progress"; }
	if($status=="codereview"){ $new_status = "Code Review"; }
	mysqli_query($con, "update tasks set status='$new_status' where id=$id");
	$seq = explode(",", $sequence);
	$ctr = 0;
	foreach ($seq as $itemid) {
		mysqli_query($con, "update tasks set seq=$ctr where id=$itemid");
		$ctr++;
	}
?>

