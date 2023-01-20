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
    <title>Profile Card Slider || Learningrobo</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://kit.fontawesome.com/3d78ad1d4b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./job_list.css?<?php echo time(); ?>"/>
    
    </head>
    <style>
      body{
        background: url(./img/h1_hero.jpg);
        background-size: cover;
      }
    </style>
  <body onload="show_popup()">
  <div class="job_apply_popup transform" id="job_apply_popup">
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
                                <input type="file" class="file_btn" id="formGroupExampleInput2" name="upload_file" required>
                                </div>
                                <div class="btn_group">
                                <button type="submit" class="btn submit_btn" name="apply_job">Submit</button>
                                <button type="button" class="btn close_btn" onclick="this.form.reset()";>Clear</button>
                                </div>
                            </form>
                        </div>
                        <script>
                            function show_popup() {
                                document.getElementById("job_apply_popup").classList.add("transform-active");
                            }
                        </script>
                    </div>
    </body>

</html>

<?php
if (isset($_POST['apply_job'])) {
  $name = $_POST['name'];
  $qualification = $_POST['qualification'];
  $grad_year = $_POST['grad_year'];
  $applied_for=$_GET['job_name'];
  
  $file_name = $_FILES['upload_file']['name'];
  $file_type = $_FILES['upload_file']['type'];
  $file_size = $_FILES['upload_file']['size'];
  $file_tmp_loc = $_FILES['upload_file']['tmp_name'];
  $path = "./Uploads/Resumes/".$file_name;

  
  // To check for any previous entry for the same job
  $applicant_id = $_SESSION['applicant_id'];
  $search_query = "SELECT * FROM `candidates_applied` WHERE `Applied_For` = '$applied_for' AND `Applicant_id` = '$applicant_id' ";
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