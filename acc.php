<?php
include("database.php");
if(!isset($_SESSION['is_logged_in']))
{
	header("Location: login.php");
	exit;
}
$id = isset($_SESSION['CustomerID']) ? $_SESSION['CustomerID'] : 0;
$sql = "SELECT * FROM beneficiaries WHERE HolderID = '$id'";
$result = mysqli_query($con, $sql); 
$totalRows = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Account Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="nav3.css">
    <style>
        .con 
        {
            background-color:aliceblue;
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
            padding-bottom: 50px;
        }

        .card 
        {
            margin-bottom: 20px;
        }

        .btn {
            font-size: 1.6rem;
        }

        .mt-5, .my-5 {
    margin-top: 13rem !important;
}

.card-title
{
    margin-bottom: .75rem;
    font-size: 17px;
    font-family: Arial, Helvetica, sans-serif;
}
.card-text
{
    margin: 5px;
    font-size: 15px;
    font-family: Arial, Helvetica, sans-serif;
}
.card-header
{
    border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
    font-size: 17px;
    font-family: Arial, Helvetica, sans-serif;
}
.table thead th 
        {
     vertical-align: bottom;
     border-bottom: 2px solid #dee2e6;
     font-size: 16px;
        }
    .table td, .table th
     {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
    font-size: 16px;
     }
        @media (max-width: 37em) {
            .hamburger-menu {
                top: 0.5rem;
                right: 1rem;
            }
            .logo {
                top: 1rem;
                left: 1rem;
            }
            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <img src="logo.png" alt="" class="logo">
    <div class="overlay overlay-slide-left" id="overlay">
        <nav>
            <ul>
                <li id="nav-1" class="slide-out-1 center">
                    <a href="acc.php" class="center" id="on">My Account</a>
                </li>
                <li id="nav-2" class="slide-out-2 center">
                    <a href="Financial_history.php" class="center">Financial History</a>
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
    <div class="con">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Account Holder Details
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Customer Information</h5>
                            <?php
                            if(!isset($_SESSION['is_logged_in']))
                            {
                                header("Location: project_DB.php");
                                exit;
                            }
                            $customer_id = $_SESSION['CustomerID'];
                            $message = 'no such customer found';

                            if($customer_id > 0)
                            {
                                $sql = "SELECT * FROM customers where CustomerID = '$customer_id'";
                                $rs = mysqli_query($con, $sql);
                                $row = mysqli_fetch_assoc($rs);    
                            }
                            else
                            {
                                echo $message;
                            }
                            echo '
                            <p class="card-text">Customer ID: <strong>'.$customer_id.'</strong></p>
                            <p class="card-text">Name: <strong>'.$row["name"].'</strong></p>
                            <p class="card-text">Email: <strong>'.$row["Email"].'</strong></p>
                            <p class="card-text">Phone: <strong>'.$row["Phone"].'</strong></p>
                            <p class="card-text">Address: <strong>'.$row["Address"].'</strong></p>'
                            ?>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header bg-primary text-white">
                            Account  Information
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Account Details</h5>
                            <?php
                            $customer_id = $_SESSION['CustomerID'];
                            $message = 'no such customer found';

                            if($customer_id > 0)
                            {
                                $sql = "SELECT * FROM accounts where CustomerID = '$customer_id'";
                                $rs = mysqli_query($con, $sql);
                                $row = mysqli_fetch_assoc($rs);    
                            }
                            else
                            {
                                echo $message;
                            }
                            echo
                            '<p class="card-text">Account ID: <strong>'.$row["AccountID"].'</strong></p>
                            <p class="card-text">Account Type: <strong>'.$row["AccountType"].'</strong></p>
                            <p class="card-text">Balance: <strong>'.$row["Balance"].'</strong></p>
                            <p class="card-text">Loans: <strong>'.$row["Loans"].'</strong></p>'
                            ?>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header bg-primary text-white">
                            Beneficiaries
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">  Beneficiaries Details</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Beneficiary ID</th>
                                    <th>Beneficiary Name</th>
                                    <th>Relationship With Beneficiary</th>
                                    <th>Beneficiary Contact Info</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($totalRows > 0) 
                            {
                                while($row = mysqli_fetch_assoc($result))
                                 {
                                    echo '<tr>';
                                    echo '<td>'.$row['AccountID'].'</td>';
                                    echo '<td>'.$row['Name'].'</td>';
                                    echo '<td>'.$row['Relationship'].'</td>';
                                    echo '<td>'.$row['ContactInfo'].'</td>';
                                    echo '</tr>';
                                }
                            } else 
                            {
                                echo '<tr><td colspan="3">No Beneficiaries Declared.</td></tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="Transaction.html" class="btn btn-primary btn-lg ml-2">Transfer Funds</a>
                        <a href="Loan.html" class="btn btn-info btn-lg ml-2">Loans</a>
                        <a href="delete.php" onclick="return confirm('Do you really want to delete your account?');" class="btn btn-danger btn-lg ml-2">Delete Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    <?php
    $sql = "SELECT * FROM customers WHERE CustomerID = '$customer_id'";
    $rs = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($rs);
    $name = $row["name"];
    ?>

    let customer_name = <?php echo json_encode($name); ?>;
    
    alert(" Welcome to Your Personal Account! "+customer_name +".");
</script>
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


