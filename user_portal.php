<?php
include "config.php";
session_start();
if(!isset($_SESSION['applicant_name'])){
  header("location: login_form.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://kit.fontawesome.com/3d78ad1d4b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="./portal.css?<?php echo time(); ?>"/>
    <link rel="stylesheet" href="./job_list.css?<?php echo time(); ?>"/>
  </head>
  <body>
    <nav>
      <div class="navigation">
        <div class="sidenav" id="jstoggle">
          <div class="admin_details">
            <li><i class="fa-solid fa-circle-user"></i></li>
            <li><?php echo strtok($_SESSION['applicant_name'],' ');  ?></li>
          </div>
          <div class="Widgets" id="jstoggle">
            <a href="./user_portal.php" class="active"><i class="fa-solid fa-gauge"></i>Dashboard</a>
            <a href="#"><i class="fa-sharp fa-solid fa-gear"></i>Jobs</a>
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
            <h3 class="logo">User Portal</h3>
          </div>
        </div>
        <div class="admin_page" id="jsshift_dash">        
            <div class="admin_links">
            <div class="current_page"><h2>Recent Job Post</h2></div>
            </div>
            <div class="post_container" id="post_container">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php
                                $select_query = " SELECT * FROM `jobpost_details` ";
                                
                                $result = mysqli_query($connection,$select_query);
                                while($data = mysqli_fetch_assoc($result)){
                            ?>
                                <div class="swiper-slide">
                                <div class="job-content">
                                    <div class="job_details">
                                    <div class="job_title">
                                        <h3>Recquirement For</h3>
                                        <h1 style="font-size: 32px;"><?php echo $data['Position']; ?></h1>
                                        <h5>At <?php echo $data['Company_name']; ?></h5>
                                    </div>
                                        <div class="job_desc">
                                        <div class="about_job">
                                            <h3>About Job</h3>
                                            <p><?php echo substr($data['Job_Description'],0,280)."...."; ?></p>
                                        </div>
                                        <div class="job_skills">
                                            <h3>Skills Rrequired</h3>
                                            <p><?php echo $data['Skills']; ?></p>
                                        </div>
                                        <div class="job_ctc">
                                            <h3>CTC</h3>
                                            <p><?php echo $data['CTC']; ?></p>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="lower_btns">
                                    <div class="btn">
                                        <?php echo '<a href="./job_applyform.php?job_name='.$data['Position'].'" class="apply_btn">Apply Now</a>'; ?>
                                        <a href="#" class="view_btm">View Details&nbsp;<i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                    <span class="vews_comm">
                                        <i class="fa-regular fa-eye"></i>&nbsp;1.2K<span class="part"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-regular fa-comment"></i>&nbsp;6
                                    </span>
                                    </div>
                                </div>
                                </div>

                            <?php
                                }
                            ?>       
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
                <script>
                    var swiper = new Swiper(".mySwiper", {
                    slidesPerView: 2,
                    spaceBetween: 30,
                    slidesPerGroup: 2,
                    loop: true,
                    loopFillGroupWithBlank: true,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    });
                </script>
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
