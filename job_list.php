<?php
include "config.php";
session_start();
if(!isset($_SESSION['applicant_name'])){
  header("location: login_form.php");
  exit;
}
$applied_for="";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Profile Card Slider || Learningrobo</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://kit.fontawesome.com/3d78ad1d4b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="./css/job_list.css?<?php echo time(); ?>"/>
  </head>
  <body>
    <section id="section">
      <div class="swiper mySwiper">
        <h1 class="h1">Recent Job Post <a href="log_out.php"> LOG OUT</a></h1>
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
                                <p><?php echo $data['Job_Description']; ?></p>
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
                            <a href="#" class="apply_btn" onclick="show_popup()">Apply Now <?php $applied_for = $data['Position'] ?></a>
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
      </section>

      <div class="job_apply_popup transform" id="job_apply_popup">
        <span class="closebtn" onclick="hide_popup()">&times;</span>
        <div class="post_content">
          <form action="" method="POST" id="myForm" enctype="multipart/form-data">
            <div class="form-group">
              <label for="formGroupExampleInput">Name</label>
              <input type="text" class="form-control" id="formGroupExampleInput" name="name" required>
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Qualification</label>
              <input type="text" class="form-control" id="formGroupExampleInput2" name="qualification" required>
            </div>
            <div class="form-group">
              <label for="comment">Graduation Year</label>
              <input type="text" class="form-control" id="formGroupExampleInput2" name="grad_year" required>
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Resume</label>
              <input type="file" class="file_btn form-control" id="formGroupExampleInput2" name="upload_file" required>
            </div>
            <div class="btn_group">
              <button type="submit" class="btn submit_btn" name="apply_job">Submit</button>
              <button type="button" class="btn close_btn" onclick="this.form.reset()";>Clear</button>
            </div>
          </form>
        </div>
        
        <script>
          function show_popup() {
            document.getElementById("section").style.opacity = "0.4";
            document.getElementById("job_apply_popup").classList.add("transform-active");
          }
          function hide_popup() {
            document.getElementById("job_apply_popup").classList.remove("transform-active");
            document.getElementById("section").style.opacity = "1";
          }
        </script>
      </div>
    </body>
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
</html>

<?php
if (isset($_POST['apply_job'])) {
  $name = $_POST['name'];
  $qualification = $_POST['qualification'];
  $grad_year = $_POST['grad_year'];
  
  $file_name = $_FILES['upload_file']['name'];
  $file_type = $_FILES['upload_file']['type'];
  $file_size = $_FILES['upload_file']['size'];
  $file_tmp_loc = $_FILES['upload_file']['tmp_name'];
  $path = "./Uploads/Resumes/".$file_name;

  
  // To check for any previous entry for the same job
  $applicant_id = $_SESSION['applicant_id'];
  $search_query = "SELECT * FROM `candidates_applied` WHERE `Applied_For` = '$applied_for' and `Applicant_id` = '$applicant_id' ";
  $result2 = mysqli_query($connection, $search_query);
  
  if(mysqli_num_rows($result2) == 1){
    echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol></svg>
    <div style="z-index:100; position: absolute; top:0px; right:0px; width: 100%;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    You have <strong> Alredy Applied! </strong>for this job.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    exit;
  }
  else{
    $insert_query = "INSERT INTO `candidates_applied`(`Name`,`Applicant_id`, `Applied_For`,`Qualification`, `YearOf_Graduation`, `Resume`) VALUES('$name','$applicant_id','$applied_for','$qualification','$grad_year','$file_name') ";
    $result = mysqli_query($connection, $insert_query);
    
    if(move_uploaded_file($file_tmp_loc,$path) && $result) {
      echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
      </symbol>
      <div style="z-index:100; position: absolute; top:0px; right:0px; width: 100%;" class="alert alert-success alert-dismissible fade show" role="alert">
      <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
      Job has been posted<strong> Successfully! </strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      exit;
    } else {
        echo 'Error: Could not able to execute $insert_query. ' . mysqli_error($connection);
    }
  }
}

?>