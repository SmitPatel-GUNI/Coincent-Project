<?php
include 'config.php';
if (isset($_POST['Applicant_signUp'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $number = $_POST['phone_no'];

    $result = mysqli_query($connection,"SELECT MAX(Id) FROM applicants");
    $row = mysqli_fetch_row($result);
    $applicant_id = "A_".$row[0]+1;
    
    $search_query = "SELECT * FROM `applicants` WHERE `Email` = '$email' ";
    $result = mysqli_query($connection, $search_query);
    $row = mysqli_num_rows($result);
    if ($row==1) {
        echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol></svg>
            <div style="z-index:100; position: absolute; top:0px; right:0px; width: 100%;" class="alert alert-danger alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            Email <strong>Alredy</strong> registered. Try <a style="text-decoration:none;" href="./login_form.php">Login!</a> or use different <strong>email</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            exit;
    }
    else{
        $insert_query = "INSERT INTO `applicants`(`Applicant_id`,`Name`, `Email`, `Password`, `Number`) VALUES ('$applicant_id','$name','$email','$password','$number')";
        if (($cpassword != $password )){
            echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol></svg>
                <div style="z-index:100; position: absolute; top:0px; right:0px; width: 100%;" class="alert alert-warning alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                Confirm password not matched <strong>Try Again!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        elseif (($cpassword === $password ) && mysqli_query($connection, $insert_query)) {
            echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <div style="z-index:100; position: absolute; top:0px; right:0px; width: 100%;" class="alert alert-success alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                Your account has been <strong>Successfully Created </strong><a style="text-decoration:none;" href="./login_form.php">Login</a> Now!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }
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
    <link rel="stylesheet" href="./css/form2.css?<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <section>
        <div class="container">
        <h1>Sign Up for Free</h1>
        <form action="" method="post">
            <div class="form_group">
                <div class="inputbox">
                    <input type="text" placeholder="Name" name="name" required>
                </div>
                <div class="inputbox">
                    <input type="text" placeholder="Email" name="email" required>
                </div>
                <div class="inputbox">
                    <input type="text" placeholder="Phone Number" name="phone_no" required>
                </div>
                <div class="inputbox">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="inputbox">
                    <input type="password" placeholder="Confirm Password" name="cpassword" required>
                </div>
                <div class="btn_group">
                    <a href="./login_form.php">Login</a>
                    <button class="btn" type="submit" name="Applicant_signUp">Create Account</button>
                </div>
            </div>
        </form>
        </div>
    </section>
</body>
</html>