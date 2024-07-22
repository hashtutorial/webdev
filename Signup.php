<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            background-size: cover;
            background-repeat: no-repeat;
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        .con {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .inp {
            display: inline-block;
            width: 20rem;
        }
        .logo {
            position: absolute;
            left: 20px;
            top: 20px;
            width: 150px;
            height: auto;
        }
        .form-container {
            margin-top: 50px;
        }
        .form-group label {
            font-size: 16px;
        }
        .form-control {
            font-size: 14px;
        }
        .btn {
            font-size: 16px;
        }
    </style>
    <link rel="stylesheet" href="nav2.css">
</head>
<body>
    <img src="logo.png" alt="" class="logo">
    <div class="overlay overlay-slide-left" id="overlay">
        <nav>
            <ul>
                <li id="nav-1" class="slide-out-1 center">
                    <a href="project_DB.php" class="center">Home</a>
                </li>
                <li id="nav-2" class="slide-out-2 center">
                    <a href="Signup.php" class="center" id="on">Signup</a>
                </li>
                <li id="nav-3" class="slide-out-3 center">
                    <a href="services.html" class="center">Services</a>
                </li>
                <li id="nav-4" class="slide-out-4 center">
                    <a href="about.html" class="center">About</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="hamburger-menu" id="hamburger-menu">
        <div class="menu-bar1"></div>
        <div class="menu-bar2"></div>
        <div class="menu-bar3"></div>
    </div>

    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <form action="make.php" method="post" name="form2">
              <div class="text-center mb-4">
                <img class="rounded-lg" src="pics/b.jfif" alt="" width="500" height="250">
              </div>  
              <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" name="uname" id="inputName" required>
              </div>
              <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" name="uadd" id="inputAddress" placeholder="1234 Main St" required>
              </div>
              <div class="form-group">
                <label for="inputphone">Phone</label>
                <input type="text" class="form-control" name="uphone" id="inputphone" placeholder="033-2342-2209" required>
              </div>
              <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" name="umail" id="inputEmail4" required>
              </div>
              <div class="form-group">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" name="upass" id="inputPassword4" required>
              </div>
              <div class="form-group">
                                <label for="accType">Account Type</label>
                                <select class="form-control" id="accType" name="utype" required>
                                    <option value="" disabled selected>Select Account Type</option>
                                    <option value="Fixed Deposit" selected>Fixed Deposit</option>
                                    <option value="Savings">Savings</option>
                                    <option value="Joint">Joint</option>
                                    <option value="Premium">Premium</option>
                                </select>
                            </div>    
              <div class="form-group">
                <label for="inputbalance">Balance to transfer</label>
                <input type="number" class="form-control" name="ubalance" id="inputbalance" required>
              </div>
              <button type="submit" class="btn btn-primary btn-sm btn-block rounded-pill">Submit</button>
            </form>
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
        
        function toggleNav() {
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

