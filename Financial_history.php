<?php
include("database.php");
if(!isset($_SESSION['is_logged_in']))
{
	header("Location: login.php");
	exit;
}

$sql = "SELECT * FROM Transactions WHERE AccountID IN (SELECT AccountID FROM accounts WHERE CustomerID = {$_SESSION['CustomerID']})";
$result = mysqli_query($con, $sql); 
$totalRows = mysqli_num_rows($result);//number of rows in result of query

$sql2 = "SELECT * FROM Loans WHERE CustomerID = {$_SESSION['CustomerID']}";
$result2 = mysqli_query($con, $sql2); 
$totalRows2 = mysqli_num_rows($result2);//number of rows in result of query
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="nav3.css"> 
    <style>
        body 
        {
            font-family: Arial, sans-serif;
        }
        .container 
        {
            margin-top: 120px;
        }
        .card-header 
        {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            font-size: 25px;
        }
        .card-body 
        {
            background-color: #f8f9fa;
        }
        .card-title
        {
            font-size: 25px;
        }
        .btn 
        {
            margin-top: 20px;
        }
        .table thead th 
        {
     vertical-align: bottom;
     border-bottom: 2px solid #dee2e6;
     font-size: 18px;
        }
    .table td, .table th
     {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
    font-size: 16px;
     }
    </style>
</head>
<body>
    <img src="logo.png" alt="" class="logo">
    <div class="overlay overlay-slide-left" id="overlay">
        <nav>
            <ul>
                <li id="nav-1" class="slide-out-1 center">
                    <a href="acc.php" class="center">My Account</a>
                </li>
                <li id="nav-2" class="slide-out-2 center">
                    <a href="Financial_history.php" class="center" id="on">Financial History</a>
                </li>
                <li id="nav-3" class="slide-out-3 center">
                    <a href="Customer_support.html" class="center">Customer Support</a>
                </li>
                <li id="nav-4" class="slide-out-4 center">
                    <a href="Beneficiary.html" class="center">Add Beneficiary</a>
                </li>
                <li id="nav-5" class="slide-out-5 center">
                    <a href="project_DB.php" class="center">Logout</a>
                </li>
            </ul>
        </nav>
    </div>
  
    <div class="hamburger-menu" id="hamburger-menu">
        <div class="menu-bar1"></div>
        <div class="menu-bar2"></div>
        <div class="menu-bar3"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Financial History
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Transaction History</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Recipient ID</th>
                                    <th>Transaction Type</th>
                                    <th>Time Stamp</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($totalRows > 0)
                             {
                                while($row = mysqli_fetch_assoc($result)) 
                                {
                                    echo '<tr>';
                                    echo '<td>'.$row['TransactionID'].'</td>';
                                    echo '<td>$'.$row['Amount'].'</td>';
                                    echo '<td>'.$row['RecepientID'].'</td>';
                                    echo '<td>'.$row['TransactionType'].'</td>';
                                    echo '<td>'.$row['TransactionDate'].'</td>';
                                    echo '</tr>';
                                }
                            } 
                            else
                             {
                                echo '<tr><td colspan="5">No Transactions Made.</td></tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                        <h5 class="card-title">Loan History</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Loan ID</th>
                                    <th>Amount</th>
                                    <th>Time Stamp</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($totalRows2 > 0) 
                            {
                                while($row2 = mysqli_fetch_assoc($result2))
                                 {
                                    echo '<tr>';
                                    echo '<td>'.$row2['LoanID'].'</td>';
                                    echo '<td>$'.$row2['Amount'].'</td>';
                                    echo '<td>'.$row2['LoanDate'].'</td>';
                                    echo '</tr>';
                                }
                            } else 
                            {
                                echo '<tr><td colspan="3">No Loans Pending.</td></tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
        const hamburgerMenu = document.querySelector("#hamburger-menu");
    const overlay = document.querySelector("#overlay");
    const nav1 = document.querySelector("#nav-1");
    const nav2 = document.querySelector("#nav-2");
    const nav3 = document.querySelector("#nav-3");
    const nav4 = document.querySelector("#nav-4");
    const nav5 = document.querySelector("#nav-5");
    const navItems = [nav1, nav2, nav3, nav4, nav5];
    
    function navAnimation(val1, val2) {
      navItems.forEach((nav, i) => {
        nav.classList.replace(`slide-${val1}-${i + 1}`, `slide-${val2}-${i + 1}`);
      });
    }
    
    function toggleNav() 
    {
      hamburgerMenu.classList.toggle("active");
      overlay.classList.toggle("overlay-active");
    
      if (overlay.classList.contains("overlay-active")) {
        overlay.classList.replace("overlay-slide-left", "overlay-slide-right");
        navAnimation("out", "in");
      } else {
        overlay.classList.replace("overlay-slide-right", "overlay-slide-left");
        navAnimation("in", "out");
      }
    }
    hamburgerMenu.addEventListener("click", toggleNav);
    navItems.forEach((nav) => {
      nav.addEventListener("click", toggleNav);
    });
    
      </script>
</body>
</html>
