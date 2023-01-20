<?php
include 'config.php';
$error = false;
if (isset($_POST['login'])) {   
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $search_query1 = "SELECT * FROM `recruiters` WHERE `Email` = '$email' AND `Password` = '$password' ";
    $result1 = mysqli_query($connection, $search_query1);
    $data1 = mysqli_fetch_array($result1);
    
    $search_query2 = "SELECT * FROM `applicants` WHERE `Email` = '$email' AND `Password` = '$password' ";
    $result2 = mysqli_query($connection, $search_query2);
    $data2 = mysqli_fetch_array($result2);
    
    if (mysqli_num_rows($result1) == 1) {
            session_start();
            $_SESSION['recruiter_name'] = $data1['Name'];
            $_SESSION['recruiter_id'] = $data1['Recruiter_Id'];
            header("location:job_portal.php");
        } elseif (mysqli_num_rows($result2) == 1) {
            session_start();
            $_SESSION['applicant_name'] = $data2['Name'];
            $_SESSION['applicant_id'] = $data2['Applicant_id'];
            header("location:user_portal.php");
        } else {
            $error = true;
        }
}
if ($error) {
    echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol></svg>
    <div style="z-index:100; position: absolute; top:0px; right:0px; width: 100%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    Incorrect <strong>Email or Password. </strong>Try Again!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="form2.css?<?php echo time(); ?>">
    <script>
        function preventBack(){
            window.history.forward()};
            setTimeout ("preventBack()",0);
            window.onunload=function(){nul1;}
    </script>
</head>
<body>
    <section style="padding: 10% 30%;">
        <div class="container" style="height: 300px;">
            <h1>Welcome back!</h1>
            <form action="" method="post">
                <div class="form_group">
                    <div class="inputbox">
                        <input type="text" placeholder="Email" name="email" required>
                    </div>
                    <div class="inputbox">
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="btn_group">
                        <a href="./index.php">Register</a>
                        <button class="btn" type="submit" name="login">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
</html>