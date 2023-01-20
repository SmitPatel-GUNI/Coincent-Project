<!DOCTYPE html>
<?php include 'config.php';?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./index.css?<?php echo time(); ?>">
</head>
<body>
  <nav>
    <div class="navbar">
      <div class="web_Logo"><a href="">WEBSITE</a></div>
      <div class="page_links">
        <ul>
          <li><a class="active_link" href="">Home</a></li>
          <li><a href="">Recent Jobs</a></li>
          <li><a href="">About</a></li>
          <li><a href="">Contact</a></li>  
        </ul>
      </div>
      <div class="web_btn">
        <a class="register_btn hover_btn" onclick="show_popup()" href="#">Register</a>
        <a class="login_btn hover_btn" href="./login_form.php">Login</a>
      </div>
      <div class="side_nav">
        <div class="sidenav" id="jsSidenav">
          <a class="closebtn" onclick="closeNav()">&times;</a>
          <a href="#">Home</a>
          <a href="./job_list.php">Find a Jobs</a>
          <a href="#">About</a>
          <a href="#">Page</a>
          <a href="#">Contact</a>
          <a href="#">Register</a>
          <a href="#">Login</a>
        </div>
        <span class="open_btn" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
          <script>
            function openNav() {
              document.getElementById("jsSidenav").style.width = "200px";
            }
            function closeNav() {
              document.getElementById("jsSidenav").style.width = "0";
            }
            </script>
      </div>
    </div>
  </nav>
  <section>
    <div class="web_banner">
      <div class="banner_container">
        <h1>Recruit And <br>Get Job At One Place</h1>
        <div class="banner_btn web_btn">
            <a class="recruite_btn hover_btn" href="./job_list.php">Recruit</a>
            <a class="apply_btn hover_btn" href="./user_portal.php">Apply</a>
        </div>
      </div>
    </div>
    <div class="register_popup" id="register_popup">
      <h3>Register As</h3>
      <span class="closebtn" onclick="hide_popup()">&times;</span>
      <a class="recruiter_btn pop_btn" href="./recruiter_signup_form.php">Recruiter</a>
      <a class="applicant_btn pop_btn" href="./applicant_signup_form.php">Applicant</a>
      <script>
        function show_popup() {
              document.getElementById("register_popup").style.display = "flex";
            }
        function hide_popup() {
              document.getElementById("register_popup").style.display = "none";
            }
      </script>
    </div>
  </section>
</body>
</html>