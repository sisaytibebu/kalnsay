<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $cpass = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    // Initialize $profilePhotoPath
    $profilePhotoPath = "";
    $uploadDir = __DIR__ . ''; // Corrected upload path

    // Handle File Upload
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        $profilePhotoName = $_FILES['profile_photo']['name'];
        $profilePhotoTmpName = $_FILES['profile_photo']['tmp_name'];
        $profilePhotoSize = $_FILES['profile_photo']['size'];
        $profilePhotoError = $_FILES['profile_photo']['error'];
        $profilePhotoType = $_FILES['profile_photo']['type'];
        $profilePhotoExt = explode('.', $profilePhotoName);
        $profilePhotoActualExt = strtolower(end($profilePhotoExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($profilePhotoActualExt, $allowed)) {
            if ($profilePhotoSize < 1000000) { // 1MB
                $profilePhotoNameNew = uniqid('', true) . "." . $profilePhotoActualExt;
                $profilePhotoPath = '' . $profilePhotoNameNew;
                if (!move_uploaded_file($profilePhotoTmpName, $profilePhotoPath)) {
                    $error[] = 'Failed to move uploaded file.';
                }
            } else {
                $error[] = 'Your image file is too large';
            }
        } else {
            $error[] = "Your file is not an image.";
        }
    } else if ($_FILES['profile_photo']['error'] !== 4) { // Check if there is any other error, if file is not uploaded and error is 4 we don't need to do anything
          $error[] = 'There was an error uploading image.';
    }

    // Check if user already exists by email
    $select = "SELECT * FROM user_form WHERE email='$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists';
    } else {
        if (!password_verify($cpass, $pass)) {
            $error[] = 'Passwords do not match!';
        } else {
             // Insert user into database
            $insert = "INSERT INTO user_form(name, email, password, user_type, profile_photo) VALUES('$name', '$email', '$pass', '$user_type', '$profilePhotoPath')";
            if (mysqli_query($conn, $insert)) {
                header('location:login_form.php');
                exit();
            } else {
                $error[] = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<a href="index.html"><button style="color:violet; font-size:20px;"><-Back to Home</button></a>
    <div class="form-container">
       <form action="" method="post" enctype="multipart/form-data">
       <h3>Signup Now</h3>
       <?php
       if (isset($error)) {
           foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
           }
       }
       ?>
       <input type="text" name="name" required placeholder="Enter your name">
       <input type="email" name="email" required placeholder="Enter your email">
       <input type="password" name="password" required placeholder="Enter your password">
       <input type="password" name="cpassword" required placeholder="Confirm your password">
        <input type="file" name="profile_photo" accept="image/*" required>
       <select name="user_type">
           <option value="user">High School</option>
           <option value="user">University</option>
       </select>
       <input type="submit" name="submit" value="Register" class="form-btn">
       <p>Already have an account? <a href="login_form.php">Login now</a></p>
       </form>
    </div>
</body>
</html>
