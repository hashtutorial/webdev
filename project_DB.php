<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Banking Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="nav2.css">
    <style>
      body
    {
    font-family:"Nunito",sans-serif;
    background-image: url('pics/pexels-worldspectrum-844124.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    height: 120vh;
    }
 .Login
  {
   float: left;
   margin-top: 0px;
   margin-left: -35px;
   padding:50px;
  }
.lab
{
display: block; 
font-size: 25px;
color: #F1CE72;
font-family: sans-serif;
text-decoration: none;
}
.lab:hover
{
cursor: pointer;
color: cornflowerblue;
text-decoration: none;
}
.px-4 
{
    padding-left: 5rem !important;
}
.py-3 
{
    padding-top: 13rem !important;
}
.menu-bar1,
.menu-bar2,
.menu-bar3 
{
  width: 3.5rem;
  height: 0.2rem;
  background-color: whitesmoke; /* Hamburger bar color */
  margin: 0.8rem 0;
  transition: 0.4s;
}
.custom-input {
    width: 22rem; 
}
.footer {
        text-align: center;
        padding: 10px;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        /* background-color: #000; */
        color: white;
        text-align: center;
        font-size: 13px;
      }
    </style>
</head>
<body>
<img src="logo.png" alt="" class="logo">
  <div class="overlay overlay-slide-left" id="overlay">
    <nav>
      <ul>
        <li id="nav-1" class="slide-out-1 center">
          <a href="project_DB.php" class="center" id="on">Home</a>
        </li>
        <li id="nav-2" class="slide-out-2 center">
          <a href="Signup.php" class="center">Signup</a>
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

   <!--Side Login  -->
   <div class="Login">
    <form action="login.php" method="post" name="form1" class="px-4 py-3" id="form1">
        <div class="form-group">
            <label for="Email1" class="lab">Email address</label>
            <input type="email" name="Useremail" class="form-control form-control-lg custom-input" id="Email1" placeholder="user@mail.com">
        </div>
        <div class="form-group">
            <label for="password" class="lab">Password</label>
            <input name="password" type="password" class="form-control form-control-lg custom-input" id="password" required placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
        <input type="reset" class="btn btn-primary btn-lg">
    </form>
</div>
      <?php
	  // if(isset($_GET['status']) && $_GET['status'] == 'fail')
	  // {
    // 	echo '<p>Invalid Roll No. or Password. Please try again!</p>';
	  // }  
	  // echo '<pre>';
	  // print_r($_SESSION);
	  ?>
	  <footer class="footer">
  © 2024 Barclays. All Rights Reserved.
</footer>
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


