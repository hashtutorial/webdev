<?php
include("database.php");
// if(!isset($_SESSION['is_logged_in']))
// {
// 	header("Location: project_DB.php");
// 	exit;
// }
$Useremail = isset($_REQUEST['umail']) ? $_REQUEST['umail'] : '';
$password = isset($_REQUEST['upass']) ? $_REQUEST['upass'] : '';
$name = isset($_REQUEST['uname']) ? $_REQUEST['uname'] : '';
$address = isset($_REQUEST['uadd']) ? $_REQUEST['uadd'] : '';
$phone = isset($_REQUEST['uphone']) ? $_REQUEST['uphone'] : '';
$type = isset($_REQUEST['utype']) ? $_REQUEST['utype'] : '';
$balance = isset($_REQUEST['ubalance']) ? $_REQUEST['ubalance'] : '';
$loan = 0;

$notification = '';

if($name != '') 
{
    $sql_query = "INSERT INTO customers (name, Email, Phone, Address, password, last_login) VALUES ('$name', '$Useremail', '$phone', '$address', '$password', '')";
    $rs = mysqli_query($con, $sql_query);
    
    if (!$rs) {
        $notification = '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($con) . '</div>';
    } 

    else 
    {
        $sq = "SELECT CustomerID, name FROM customers WHERE Email = '$Useremail' AND password = '$password'";
        $rs = mysqli_query($con, $sq);
        $row = mysqli_fetch_assoc($rs);
        $cid = $row['CustomerID'];
        
        $s = "INSERT INTO accounts (CustomerID, AccountType, Balance, Loans) VALUES ('$cid', '$type', '$balance', '$loan')";
        
        if (mysqli_query($con, $s)) {
            $notification = '<div class="alert alert-success" role="alert">Welcome to Barclays Holdings as a new client.</div>';
        } else {
            $notification = '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($con) . '</div>';
        }
    }
}
else
{
    $notification = '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($con) . '</div>'; 
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
        body {
            background-color: black;
        }
        .footer {
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
        <a href="logout.php" class="btn btn-primary ml-2">Login</a>
    </footer>
</body>
</html>
