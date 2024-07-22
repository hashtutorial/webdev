<?php
include("database.php");
if(!isset($_SESSION['is_logged_in']))
{
    header("Location: project_DB.php");
    exit;
}
$amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : '';
$id = isset($_SESSION['CustomerID']) ? $_SESSION['CustomerID'] : 0;

$my_balance_query = "SELECT Balance FROM accounts WHERE CustomerID = '$id'";
$my_balance_result = mysqli_query($con, $my_balance_query);
$my_balance_row = mysqli_fetch_assoc($my_balance_result);
$my_balance = intval($my_balance_row['Balance']); // Converting to integer


$my_loan_query = "SELECT Loans FROM accounts WHERE CustomerID = '$id'";
$my_loan_result = mysqli_query($con, $my_loan_query);
$my_loan_row = mysqli_fetch_assoc($my_loan_result);
$my_loan = intval($my_loan_row['Loans']); // Converting to integer

$llimit=20000;
$ulimit=100000;
//Check to see if current balance is between the limits
if($my_balance<$llimit )
{
    $notification = '<div class="alert alert-danger" role="alert">
    Balance Less than $20,000 Loan request rejected.
       </div>'; 
}
else if($my_balance>$ulimit )
{
    $notification = '<div class="alert alert-danger" role="alert">
    Balance Greater than $100,000 Loan request rejected.
       </div>'; 
}
else if ($my_loan+$amount>$ulimit)
{
    $notification = '<div class="alert alert-danger" role="alert">
    Loan exceeds limit($100000) Loan request rejected.
       </div>'; 
}
else
{
        $my_new_balance = $my_balance + $amount;
        $my_new_loan = $my_loan + $amount;
        $my_update_query = "UPDATE accounts SET Balance = $my_new_balance WHERE CustomerID = '$id'";
        $my_update_result = mysqli_query($con, $my_update_query);
        $my_update_query = "UPDATE accounts SET Loans = $my_new_loan WHERE CustomerID = '$id'";
        $my_update_result = mysqli_query($con, $my_update_query);

        $insert_query = "INSERT INTO loans (LoanID,CustomerID,Amount,LoanDate) VALUES ('', '$id','$amount',NOW())";
        $result = mysqli_query($con, $insert_query);

        $notification = '<div class="alert alert-success" role="alert">
        Loan Request Approved, Amount tansferred To Your Account.
           </div>';
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
<a href="acc.php" class="btn btn-primary ml-2">Back To Your Account</a>
</footer>
</body>
</html>
