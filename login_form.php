<?php
@include 'config.php';
session_start();
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password']; // Get password
    $select = "SELECT * FROM user_form WHERE email='$email'";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        // Verify the hashed password stored in the DB against input password
        if (password_verify($pass, $row['password'])) {
              if($row['user_type'] == 'admin'){
                  $_SESSION['admin_name'] = $row['name'];
                header('location:user_page.php');
               } elseif ($row['user_type'] == 'user') {
                    $_SESSION['user_name'] = $row['name'];
                    header('location:user_page.php');
                }

            } else {
                $error[] = 'incorrect email or password!';
            }

        } else {
          $error[] = 'incorrect email or password!';

        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<a href="index.html"><button style="color:violet; font-size:20px;"><-Back to Home</button></a>
    <div class="form-container">
       <form action="" method="post">
           <h3>login now</h3>
           <?php
           if(isset($error)){
               foreach($error as $error){
                   echo '<span class="error-msg">'.$error.'</span>';
               };
           };
           ?>
            <input type="email" name="email" required placeholder="enter your email">
           <input type="password" name="password" required placeholder="enter your password">
           <input type="submit" name="submit" value="login now" class="form-btn">
           <p>don't have an account? <a href="register_form.php">Signup now</a></p>
       </form>
    </div>
</body>
</html>
