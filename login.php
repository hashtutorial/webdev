<?php
include("database.php");
$Useremail = isset($_REQUEST['Useremail']) ? $_REQUEST['Useremail'] : '';
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

$sql = "select CustomerID, name from customers WHERE Email = '$Useremail' AND password = '$password'";
$rs = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($rs);
$total_rows = mysqli_num_rows($rs);
if($total_rows > 0)
{
	$ID 	= $row['CustomerID'];
	$name 		= $row['name'];
	
	$update = "UPDATE customers SET last_login = NOW() WHERE CustomerID = '$ID'";
	
	$status = mysqli_query($con, $update);
	
	$rows_affected = mysqli_affected_rows($con);

	if($rows_affected == 1)
	{
		$_SESSION['is_logged_in'] 	= 'Y';
		$_SESSION['name'] 			= $name;
		$_SESSION['CustomerID']     = $ID;	
		header("Location: acc.php");
	}
}
else 
{
	header("Location: project_DB.php?status=fail");
}
?>