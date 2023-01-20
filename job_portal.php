<?php
include 'config.php';
session_start();
if(!isset($_SESSION['recruiter_name'])){
  header("location: login_form.php");
  exit;
}

    $recruiter_id = $_SESSION['recruiter_id'];
    $search_query = "SELECT * FROM `jobpost_details` WHERE `Recruiter_Id` = '$recruiter_id' ";
    $result = mysqli_query($connection, $search_query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://kit.fontawesome.com/3d78ad1d4b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./portal.css?<?php echo time(); ?>"/>
  </head>
  <body>
    <nav>
      <div class="navigation">
        <div class="sidenav" id="jstoggle">
          <div class="admin_details">
            <li><i class="fa-solid fa-circle-user"></i></li>
            <li><?php echo strtok($_SESSION['recruiter_name'],' ');  ?></li>
          </div>
          <div class="Widgets" id="jstoggle">
            <a href="./job_portal.php" class="active"><i class="fa-solid fa-gauge"></i>Dashboard</a>
            <a href="./job_posting.php"><i class="fa-sharp fa-solid fa-gear"></i>Jobs</a>
            <a href="./index.php"><i class="fa-sharp fa-solid fa-graduation-cap"></i>Contact</a>
            <a href="./index.php"><i class="fa-solid fa-user-group"></i>About</a>
            <a href="./log_out.php"><i class="fa-solid fa-right-from-bracket"></i>Sign Out</a>
          </div>
        </div>
      </div>
    </nav>
    <section>
      <div class="admin_dashboard">
        <div class="dashboard_header">
          <div class="head_nav shift_header" id="jsshift">
            <div class="toggle_btn" onclick="toggle_nav()">
              <span class="hamburger" id="jstoggle_shift"></span>
            </div>
            <h3 class="logo">COMPANY</h3>
          </div>
        </div>
        <div class="admin_page" id="jsshift_dash">        
          <div class="admin_links">
            <div class="current_page"><h2>Dashboard</h2></div>
            <div class="posting_btn"><a href="job_posting.php">Post a Job</a></div>
          </div>
          <div class="post_content">
            <div class="list_header">
              <div class="list_row1">
                  <h2>Your Posting</h2>
                  <a href="#view-all">View All</a>
              </div>
              <div class="list_row2">
                <div class="active_status"><a>Active(<?php echo mysqli_num_rows($result) ?>)</a></div>
                <div class="recent_status"><a>Total Post(<?php echo mysqli_num_rows($result) ?>)</a></div>
              </div>
            </div>
            <?php
              if(mysqli_num_rows($result) == 0){
                echo '<div class="post_list">
                      <div class="post_title text-center"><h2 style="margin: auto;">NO POST YET</h2></div>
                      </div>';
                    }
                else{
                while($data = mysqli_fetch_assoc($result)) {
                  $job_name = $data['Position'];
            ?>            
                <div class="post_list">
                      <div class="post_title"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="9" x2="20" y2="9"></line><line x1="4" y1="15" x2="20" y2="15"></line><line x1="10" y1="3" x2="8" y2="21"></line><line x1="16" y1="3" x2="14" y2="21"></line></svg><h5>Requirement for <?php echo $data['Position']; ?> at <?php echo $data['Company_name']; ?> Company</h5> <?php echo '<a style="position:absolute; right:65px; text-decoration:none;" href="applicant_list.php?job_name='.$job_name.'">View Applicants</a>';?></div>
                      <div class="post_details">
                        <div class="post_date">
                          <i class="fa-regular fa-calendar"></i>
                          <div class="div_align">
                            <h6>Date</h6>
                            <span><?php echo $data['Posted_on']; ?></span>
                          </div>
                        </div>
                        <span class="line"></span>
                        <div class="post_salary">
                          <i class="fa-solid fa-dollar-sign"></i>
                          <div class="div_align">
                            <h6>Salary</h6>
                            <span><?php echo $data['CTC']; ?></span>
                          </div>
                        </div>
                        <span class="line"></span>
                        <div class="post_applicants">
                          <i class="fa-solid fa-paperclip"></i>
                          <div class="div_align">
                            <h6><?php echo $data['Position']; ?></h6>
                            <span>Position</span>
                          </div>
                        </div>
                        <span class="line"></span>
                        <div class="post_applied">
                          <i class="fa-solid fa-clipboard-check"></i>
                          <div class="div_align">
                            <h6>0</h6>
                            <span>Approved</span>
                          </div>
                        </div>
                      </div>
                    </div>
            <?php
                }}
            ?>

          </div>
        </div>
      </div>
      <div id="view-all"></div>
    </section>
        <script>
          var jstoggle_shift = document.getElementById("jstoggle_shift");
          var jsshift = document.getElementById("jsshift");
          var jstoggle = document.getElementById("jstoggle");
          var jsshift_dash = document.getElementById("jsshift_dash");

          jstoggle.addEventListener("mouseup", function (event) {
            if (event.target.parentNode != jstoggle &&event.target != jstoggle) {
              jstoggle_shift.classList.remove("toggle_arrow");
              jsshift.classList.remove("shift_header");
              jstoggle.classList.remove("shift_nav");
              jsshift_dash.classList.remove("shift_dash");
            }
          });
          function toggle_nav() {
            jstoggle_shift.classList.toggle("toggle_arrow");
            jsshift.classList.toggle("shift_header");
            jstoggle.classList.toggle("shift_nav");
            jsshift_dash.classList.toggle("shift_dash");
          }
        </script>
        <div id="end"></div>
  </body>
</html>
