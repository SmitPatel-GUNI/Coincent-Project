<?php
include 'config.php';
session_start();
if(!isset($_SESSION['recruiter_name'])){
  header("location: login_form.php");
  exit;
}
else{
    $job_name=$_GET['job_name'];
    $search_query = "SELECT * FROM `candidates_applied` WHERE `Applied_For` = '$job_name' ";
    $result = mysqli_query($connection, $search_query);
    // $data = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Applicants</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/portal.css?<?php echo time(); ?>"/>
    <script src="https://kit.fontawesome.com/3d78ad1d4b.js" crossorigin="anonymous"></script>
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
            <a href="./recruiter_dashboard.php"><i class="fa-solid fa-gauge"></i>Dashboard</a>
            <a href="#" class="active"><i class="fa-sharp fa-solid fa-gear"></i>Applicants</a>
            <a href="./job_posting.php"><i class="fa-sharp fa-solid fa-gear"></i>Jobs</a>
            <a href=""><i class="fa-sharp fa-solid fa-graduation-cap"></i>Contact</a>
            <a href=""><i class="fa-solid fa-user-group"></i>About</a>
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
            <div class="current_page"><h2>All Jobs Applicants</h2></div>
          </div>
          <div class="post_content">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Applicant Name</th>
                  <th scope="col">Applied For</th>
                  <th scope="col">Applied On</th>
                  <th scope="col">Qualification</th>
                  <th scope="col">Gradduation Year</th>
                  <th scope="col">Resume</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $count=0;
                      while($row = mysqli_fetch_assoc($result)){
                        $count +=1;
                        ?>
                  <tr>
                    <td scope="row"> <?php echo $count; ?> </td>
                    <td> <?php echo $row['Name']; ?> </td>
                    <td> <?php echo $row['Applied_For']; ?> </td>
                    <td> <?php echo $row['Applied_on']; ?> </td>
                    <td> <?php echo $row['Qualification']; ?> </td>
                    <td> <?php echo $row['YearOf_Graduation']; ?> </td>
                    <td><a href="./Uploads/Resumes/<?php echo $row['Resume']; ?>"><i class="fa-solid fa-eye"></i></a></td>
                  </tr>
                <?php
                      }
                ?>
              </tbody>
            </table>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>
