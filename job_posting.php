<?php
include 'config.php';
session_start();
if(!isset($_SESSION['recruiter_name'])){
  header("location: login_form.php");
  exit;
}
if (isset($_POST['post'])){
  $company_name = $_POST['company_name'];
  $position = $_POST['position'];
  $job_description = $_POST['job_description'];
  $skills = $_POST['skills'];
  $ctc = $_POST['ctc'];
  $recruiter_id = $_SESSION['recruiter_id'];

  $result = mysqli_query($connection,"SELECT MAX(Id) FROM `jobpost_details` ");
  $row = mysqli_fetch_row($result);
  $job_id = "J_".$row[0]+1 . "R";
  $insert_query = "INSERT INTO `jobpost_details`(`Company_name`, `Position`, `Skills`, `CTC`, `Job_Description`, `Recruiter_Id`, `Job_Id`) VALUES ('$company_name','$position','$skills','$ctc','$job_description','$recruiter_id','$job_id') ";
  
  if(mysqli_query($connection,$insert_query)){
    echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <div style="z-index:100; position: absolute; top:0px; right:0px; width: 100%;" class="alert alert-success alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    Job has been posted <strong>Successfully! </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  else{
    echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol></svg>
    <div style="z-index:100; position: absolute; top:0px; right:0px; width: 100%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    Something went wrong<strong> Try Again!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job_posting</title>
    <script src="https://kit.fontawesome.com/3d78ad1d4b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./portal.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="./job_posting.css?<?php echo time(); ?>">
  </head>
  <body>
  <?php
   
  ?>
    <nav>
      <div class="navigation">
        <div class="sidenav" id="jstoggle">
          <div class="admin_details">
            <li><i class="fa-solid fa-circle-user"></i></li>
            <li><?php echo strtok($_SESSION['recruiter_name'],' ');  ?></li>
          </div>
          <div class="Widgets" id="jstoggle">
            <a href="./job_portal.php"><i class="fa-solid fa-gauge"></i>Dashboard</a>
            <a href="./job_posting.php" class="active"><i class="fa-sharp fa-solid fa-gear"></i>Jobs</a>
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
            <div class="current_page"><h2>Post a Job</h2></div>
          </div>
          <div class="post_content">
            <form action="" method="POST">
              <div class="form-group">
                <label for="formGroupExampleInput">Company Name</label>
                <input type="text" class="form-control mt-2 mb-3" id="formGroupExampleInput" name="company_name">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Position</label>
                <input type="text" class="form-control mt-2 mb-3" id="formGroupExampleInput2" name="position">
              </div>
              <div class="form-group">
                <label for="comment">Job Description</label>
                <textarea class="form-control mt-2 mb-3" rows="6" id="comment" name="job_description"></textarea>
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Skills</label>
                <input type="text" class="form-control mt-2 mb-3" id="formGroupExampleInput2" name="skills">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">CTC</label>
                <input type="text" class="form-control mt-2 mb-3" id="formGroupExampleInput2" name="ctc">
              </div>
              <div class="btn_group">
                <button type="submit" class="btn btn-primary" name="post">Post</button>
              </div>
            </form>
          </div>
        </div>
      </div>
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
  </body>
</html>
