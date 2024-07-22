<?php
include("database.php");
if (!isset($_SESSION['is_logged_in'])) 
{
    header("Location: project_DB.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $accountID = $_POST['accountID'];
    $relationship = $_POST['relationship'];
    $id = isset($_SESSION['CustomerID']) ? $_SESSION['CustomerID'] : 0;
    $my_query = "SELECT * FROM customers WHERE CustomerID = '$accountID'";
    $my_result = mysqli_query($con, $my_query);

    if ($my_result && mysqli_num_rows($my_result) > 0) 
    {
        $row = mysqli_fetch_assoc($my_result);
        $beneficiaryName = mysqli_real_escape_string($con, $row['name']);
        $beneficiaryPhone = mysqli_real_escape_string($con, $row['Phone']);
        $sql = "INSERT INTO Beneficiaries (BeneficiaryID, AccountID, HolderID, Name, Relationship, ContactInfo) 
                VALUES ('', '$accountID', '$id', '$beneficiaryName', '$relationship', '$beneficiaryPhone')";
        $result = mysqli_query($con, $sql);

        if ($result)
        {
            $notification = '<div class="alert alert-success" role="alert">  '.  $beneficiaryName .' has been Registered as your Beneficiary.</div>';
        } else 
        {
            $notification = '<div class="alert alert-danger" role="alert"> Failed to register beneficiary.</div>';
        }
    } 
    else 
    {
        $notification = '<div class="alert alert-danger" role="alert">Beneficiary Account not Found.</div>';
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
<a href="acc.php" class="btn btn-primary ml-2">Back To Your Account</a>
</footer>
</body>
</html>


