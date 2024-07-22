<?php
include("database.php");
if(!isset($_SESSION['is_logged_in']))
{
    header("Location: project_DB.php");
    exit;
}
$issue = isset($_REQUEST['issueType']) ? $_REQUEST['issueType'] : '';
$description=isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
$id = isset($_SESSION['CustomerID']) ? $_SESSION['CustomerID'] : 0;

$insert_query = "INSERT INTO customersupport (TicketID,CustomerID,IssueType,Description,IssueDate) VALUES ('', '$id','$issue', '$description',NOW())";
$result = mysqli_query($con, $insert_query);

$notification = '<div class="alert alert-info" role="alert">
Complaint registered Successfully.
   </div>';

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
