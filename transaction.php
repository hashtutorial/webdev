<?php
include("database.php");
if(!isset($_SESSION['is_logged_in']))
{
    header("Location: project_DB.php");
    exit;
}
$recepient = isset($_REQUEST['rid']) ? $_REQUEST['rid'] : '';
$amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : '';
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
$rid = isset($_REQUEST['rid']) ? $_REQUEST['rid'] : '';

$id = isset($_SESSION['CustomerID']) ? $_SESSION['CustomerID'] : 0;
$my_balance_query = "SELECT Balance FROM accounts WHERE CustomerID = '$id'";
$my_balance_result = mysqli_query($con, $my_balance_query);
$my_balance_row = mysqli_fetch_assoc($my_balance_result);
$my_balance = intval($my_balance_row['Balance']); // Converting to integer


//Check to see if current balance is less
if($my_balance<$amount)
{
    $notification = '<div class="alert alert-danger" role="alert">
    Not enough Balance( transfer money from another account or request Loan from bank).
       </div>'; 
}
else
{
$balance_query = "SELECT Balance FROM accounts WHERE CustomerID = '$recepient'";
$balance_result = mysqli_query($con, $balance_query);
$balance_row = mysqli_fetch_assoc($balance_result);
$total_balance = intval($balance_row['Balance']); // Converting to integer


$new_balance = $total_balance + $amount;
$my_new_balance = $my_balance - $amount;

if ($total_balance > 0)
{
    $update_query = "UPDATE accounts SET Balance = $new_balance WHERE CustomerID = '$recepient'";
    $update_result = mysqli_query($con, $update_query);
    $rows_affected = mysqli_affected_rows($con);

    if ($rows_affected == 1)
    {
        $my_update_query = "UPDATE accounts SET Balance = $my_new_balance WHERE CustomerID = '$id'";
        $result = mysqli_query($con, $my_update_query);

        $acc_id="Select AccountID from accounts WHERE CustomerID = '$id'";
        $result = mysqli_query($con, $acc_id);
        $row = mysqli_fetch_assoc($result);
        $acc_id = intval($row['AccountID']);

        $insert_query = "INSERT INTO transactions (TransactionID,AccountID,RecepientID,TransactionType,Amount,TransactionDate) VALUES ('', '$acc_id','$rid', '$type', '$amount',NOW())";
        $result = mysqli_query($con, $insert_query);
     
        $notification = '<div class="alert alert-info" role="alert">
        Transaction Successful.
           </div>';
    }
}
else 
{
    header("Location: acc.php?status=fail");
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
        <?php echo $notification;?>
    </div>
    
<footer class="footer">
<a href="acc.php" class="btn btn-primary ml-2">Back To Your Account</a>
</footer>
</body>
</html>
