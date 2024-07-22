<?php
include("database.php");
if(!isset($_SESSION['is_logged_in']))
{
	header("Location: project_DB.php");
	exit;
}
$customer_id = isset($_SESSION['CustomerID']) ? $_SESSION['CustomerID'] : 0;
$message = '';
if($customer_id > 0)
{
	$sql = "SELECT COUNT(*) cnt FROM customers where CustomerID = '$customer_id'";
	$rs = mysqli_query($con, $sql);
	
	$row = mysqli_fetch_assoc($rs);

    $my_loan_query = "SELECT Loans FROM accounts WHERE CustomerID = '$customer_id'";
    $my_loan_result = mysqli_query($con, $my_loan_query);
    $my_loan_row = mysqli_fetch_assoc($my_loan_result);
    $my_loan = intval($my_loan_row['Loans']); // Converting to integer

$my_balance_query = "SELECT Balance FROM accounts WHERE CustomerID = '$customer_id'";
$my_balance_result = mysqli_query($con, $my_balance_query);
$my_balance_row = mysqli_fetch_assoc($my_balance_result);
$my_balance = intval($my_balance_row['Balance']); // Converting to integer
	
	
if( $my_loan>0)
{
    $notification = '<div class="alert alert-danger" role="alert">
    Loan pending Your account cannot be deleted.
       </div>';
}
else if($my_balance>0)
{
    $notification = '<div class="alert alert-warning" role="alert">
    Balance not 0 transfer balance to another account to delete your account.
       </div>';
}
else
{	if($row['cnt'] > 0)
	{
		$delete = "DELETE FROM customers where CustomerID = '$customer_id'";
		
		mysqli_query($con, $delete);
		
		$cnt = mysqli_affected_rows($con);	

        $del = "DELETE FROM accounts where CustomerID = '$customer_id'";
		
		mysqli_query($con, $del);
		
		$affect = mysqli_affected_rows($con);	

		if ($cnt > 0 && $affect>0 )
        {
            $notification = '<div class="alert alert-primary" role="alert">
         Your account has been deleted Successfully.
            </div>';
        }
	}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Creation Notification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body 
        {
            background-color: black;
        }
        .footer 
        {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php echo $notification; ?>
    </div>
    
<footer class="footer">
<a href="project_DB.php" class="btn btn-primary ml-2">Back To Site</a>
<a href="acc.php" class="btn btn-primary ml-2">Back To Your Account</a>
</footer>
</body>
</html>
