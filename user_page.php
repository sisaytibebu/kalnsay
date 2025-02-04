<?php
@include 'config.php';
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
    exit();
}
$userName = $_SESSION['user_name'];

// Fetch user details
$stmt = $conn->prepare("SELECT name, email, profile_photo FROM user_form WHERE name = ?");
$stmt->bind_param("s", $userName);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Handle profile photo change
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = $_FILES['profile_photo']['type'];

    // Validate the file type
    if (!in_array($fileType, $allowedTypes)) {
        echo "<p style='color: red;'>Invalid file type. Please upload a JPEG, PNG, or GIF image.</p>";
    } else {
        // Define the upload directory
        $uploadDir = 'uploads/profile_photos/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate a unique name for the uploaded file
        $fileName = uniqid('profile_', true) . '.' . pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
        $filePath = $uploadDir . $fileName;

        // Move the uploaded file to the directory
        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $filePath)) {
            // Update the user's profile photo in the database
            $stmt = $conn->prepare("UPDATE user_form SET profile_photo = ? WHERE name = ?");
            $stmt->bind_param("ss", $filePath, $userName);

            if ($stmt->execute()) {
                echo "<p style='color: green;'>Profile photo updated successfully!</p>";
                // Reload the page to reflect the change
                header("Location: user_page.php");
                exit();
            } else {
                echo "<p style='color: red;'>Error updating profile photo: " . $stmt->error . "</p>";
            }
        } else {
            echo "<p style='color: red;'>Failed to upload the file. Please try again.</p>";
        }
    }
}

// Fetch user comments if any
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $comment_user = $userName;

    $stmt = $conn->prepare("INSERT INTO user_feedback (username, comment) VALUES (?, ?)");
    $stmt->bind_param("ss", $comment_user, $comment);

    if ($stmt->execute()) {
        echo "<p>Comment submitted successfully!</p>";
    } else {
        echo "<p>Error submitting comment: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$stmt = $conn->prepare("SELECT username, comment, created_at, KALNSAY FROM user_feedback WHERE username = ? ORDER BY created_at DESC");
$stmt->bind_param("s", $userName);
$stmt->execute();
$commentsResult = $stmt->get_result();
$validPages = [
    'grade9.php',
    'grade10.php',
    'grade11.php',
    'grade12.php',
    'department.php'
  ];
  $page = isset($_GET['page']) ? $_GET['page'] : '';
  if (in_array($page, $validPages)) {
    $filePath = __DIR__ . '/' . $page;
      if (file_exists($filePath)) {
          include $filePath;
         exit();
      } else {
        echo "<h1>Error: File not found.</h1>";
          exit();
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
        <div class="logo">
            <span>kalnsay</span>
        </div>
        <nav>
            <ul id="menu" class="menu">
            <div class="dropdown">
        <span><li><a href="user_page.php?page=grade9.php">Grade 9 </a></li></span>
        <div class="dropdown-content">
            <a href="#">Mathematics</a>
            <a href="#">Biology</a>
            <a href="#">Physics</a>
            <a href="#">Chemistry</a>
            <a href="#">History</a>
            <a href="#">Geography</a>
            <a href="#">Civics</a>
        </div>
    </div>
<div class="dropdown">
        <span> <li><a href="user_page.php?page=grade10.php">Grade 10</a></li></span>
        <div class="dropdown-content">
        <a href="#">Mathematics</a>
            <a href="#">Biology</a>
            <a href="#">Physics</a>
            <a href="#">Chemistry</a>
            <a href="#">History</a>
            <a href="#">Geography</a>
            <a href="#">Civics</a>
        </div>
    </div>
    <div class="dropdown">
        <span> <li> <li><a href="user_page.php?page=grade11.php">Grade 11</a></li></span>
        <div class="dropdown-content">
        <a href="#">Mathematics</a>
            <a href="#">Biology</a>
            <a href="#">Physics</a>
            <a href="#">Chemistry</a>
            <a href="#">History</a>
            <a href="#">Geography</a>
            <a href="#">Civics</a>
        </div>
    </div>
    <div class="dropdown">
        <span> <li><a href="user_page.php?page=grade12.php">Grade 12</a></li></span>
        <div class="dropdown-content">
        <a href="#">Mathematics</a>
            <a href="#">Biology</a>
            <a href="#">Physics</a>
            <a href="#">Chemistry</a>
            <a href="#">History</a>
            <a href="#">Geography</a>
            <a href="#">Civics</a>
            <a href="#">University Entrance Exam</a>
        </div>
    </div>
    <div class="dropdown">
        <span><li><a href="user_page.php?page=department.php">Department</a></li></span>
        <div class="dropdown-content">
             <a href="#">Software Engineering</a>
            <a href="#">Computer Science</a>
            <a href="#">Information System</a>
            <a href="#">Information Technology</a>
             <a href="#">Freshman Program</a>
        </div>
    </div>
    <button style=" width:80px;  margin-left:20px;height:40px;color: #fff;background-color:#5bbdd8;"><a href="logout.php">logout</a>
    </button>
       </ul>
            <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        </nav>
    </header>
    <pre>

    </pre>



    <div class="container">
    <div class="content">
        <div class="pro"><pre>

        </pre>
            <h3 style="color:green;">Hi, <span><?php echo htmlspecialchars($userName); ?></span></h3>
              <?php
            if ($row) {
                echo '<h1>Welcome, <span>' . htmlspecialchars($row['name']) . '</span></h1>';
                echo '<p>Email: ' . htmlspecialchars($row['email']) . '</p>';

                // Display current profile photo
                if ($row['profile_photo']) {
                    $image_src = htmlspecialchars($row['profile_photo']);
                    echo '<img src="' . $image_src . '" alt="Profile Photo" style="width:300px; height:auto; box-shadow:0px 0 1px #000000;border-radius:5px;">';
                }
            }
            ?>
         <form action="user_page.php" method="POST" enctype="multipart/form-data">
    <label for="profile_photo" style="display:none;"></label>
      <input type="file" name="profile_photo" id="profile_photo" accept="image/*" style="display:none; background-color:none;"required>
    <button type="button" id="changeProfileButton" style="background-color:green;color: white;width:200px;height:30px;border-radius:5px; margin:10px;">Change Profile</button>
    <br><br>
    <button type="submit" id="submitButton" style="display:none;"></button>
</form>

<script>
    document.getElementById('changeProfileButton').addEventListener('click', function() {
        document.getElementById('profile_photo').click();
    });

    document.getElementById('profile_photo').addEventListener('change', function() {
        document.getElementById('submitButton').click();
    });
</script>


        </div>
        <div class="allother">
            <h1 style="color: black;">Wellome To kalnsay</h1>
            <?php
@include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hiddenPassword = "sisayTIBebu5676";

    if ($_POST['password'] === $hiddenPassword && isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $videoTmpPath = $_FILES['video']['tmp_name'];
        $videoName = $_FILES['video']['name'];
        $uploadDir = "uploads/";

        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $uploadFilePath = $uploadDir . basename($videoName);
        if (move_uploaded_file($videoTmpPath, $uploadFilePath)) {
            $stmt = $conn->prepare("INSERT INTO video_files (video_name, video_size, video_type, file_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $videoName, $_FILES['video']['size'], $_FILES['video']['type'], $uploadFilePath);
            echo $stmt->execute() ? "Video uploaded!" : "Error saving video: " . $stmt->error;
            $stmt->close();
        } else {
            echo "Failed to upload video.";
        }
    } else {
        echo "Incorrect password or invalid file.";
    }
}

$videos = [];
// Query updated to order videos by upload_time in descending order
$result = $conn->query("SELECT id, video_name, file_path FROM video_files ORDER BY upload_time DESC");
while ($row = $result->fetch_assoc()) $videos[] = $row;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .video-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            
        }
        .video-item {
            width: 300px;
            text-align: center;
        }
        video {
            width:400px;
            height:350px;
        }
        .error-message {
            color: red;
            display: none;
        }
        #passwordContainer {
            display: none;
        }
        button {
            background-color:green;
            border-radius:5px;
            cursor: pointer;
        }
        @media screen and (max-width: 768px){
           .sis{
            margin-left:5px;
            grid-template-columns: repeat(1, 1fr) !important;
           }
        }

    </style>
</head>
<body>
<form method="POST" enctype="multipart/form-data">
    <input type="password" name="password" id="password" placeholder="Enter Password" style="display:none;" required />
    <button type="button" onclick="showPassword()">Click to Upload</button><br><br>
    <input type="file" name="video" id="video" accept="video/*" style="display:none;" required /><br><br>
    <input type="submit" value="Upload Video" id="uploadBtn" style="display:none; background:green; border-radius:5px;" />
</form>

<h2>Kalnsay Uploaded Videos</h2>
<div class="video-grid">
<div class="sis">
    <?php foreach ($videos as $video): ?>
        <div class="video-item">
            <video controls>
                <source src="<?php echo htmlspecialchars($video['file_path']); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
           
        </div>
    <?php endforeach; ?>
    </div>
</div>
<script>
function showPassword() {
    document.getElementById('password').style.display = 'inline';
    document.getElementById('video').style.display = 'inline';
    document.getElementById('uploadBtn').style.display = 'inline';
}
</script>

</body>
</html>

<?php $conn->close(); ?>

            <h3 style="color:black;">Leave a Comment</h3>
            <form method="POST" action="">
                <textarea name="comment"  rows="6" cols="42.5" placeholder="Write your comment here..." required></textarea><br><br>
                <button type="submit" name="Submit Comment" style="background-color:green; margin-top:-20px;color:bisque;width:200px;height:30px;border-radius:5px;">Submit Comment</button>
            </form>
            <h3 style="color:black;">Your Comments:</h3>
            <?php
            if ($commentsResult->num_rows > 0) {
                while ($commentRow = $commentsResult->fetch_assoc()){
                    echo '<div class="comment">';
                    echo '<p><strong>' . htmlspecialchars($commentRow['username']) . ':</strong> ' . htmlspecialchars($commentRow['comment']) . '</p>';
                    echo '<p><em>Posted on: ' . htmlspecialchars($commentRow['created_at']) . '</em></p>';
                    echo '<p><b>KALNSAY: ' . htmlspecialchars($commentRow['KALNSAY']) . '</em></p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No comments yet. Be the first to comment!</p>';
            }?>
            <div class="buttons">
        <a href="login_form.php" class="btn">Login</a>
        <a href="register_form.php" class="btn">Register</a>
        <a href="logout.php" class="btn">Logout</a>
         </div>
        </div>
    </div>
</div>
    </div>
</div>
    <script>
        function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.classList.toggle('active');
}
    </script>
    <style>
        body{
            background-color:rgb(127, 228, 196);
        }
        .pro{
            box-shadow:0px 0 2px #000000;
        }
    </style>
</body>
</html>