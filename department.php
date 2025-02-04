<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="stylewe.css">
</head>
<body>
    <header>
        <div class="logo">
            <span>kalnsay</span>
        </div>
        <nav>
            <ul id="menu" class="menu">
            <div class="dropdown">
        <span><li><a href="grade9.php">Grade 9 </a></li></span>
        <div class="dropdown-content">
            <a href="#mathematics">Mathematics</a>
            <a href="#biology">Biology</a>
            <a href="#physics">Physics</a>
            <a href="#chemistry">Chemistry</a>
            <a href="#history">History</a>
            <a href="#geography">Geography</a>
            <a href="#civics">Civics</a>
            <a href="#economics">Economics</a>
        </div>
    </div>

    <div class="dropdown">
        <span> <li><a href="grade10.php">Grade 10</a></li></span>
        <div class="dropdown-content">
            <a href="#mathematics">Mathematics</a>
            <a href="#biology">Biology</a>
            <a href="#physics">Physics</a>
            <a href="#chemistry">Chemistry</a>
            <a href="#history">History</a>
            <a href="#geography">Geography</a>
            <a href="#civics">Civics</a>
            <a href="#economics">Economics</a>
        </div>
    </div>
    <div class="dropdown">
        <span> <li> <li><a href="grade11.php">Grade 11</a></li></span>
        <div class="dropdown-content">
            <a href="#mathematics">Mathematics</a>
            <a href="#biology">Biology</a>
            <a href="#physics">Physics</a>
            <a href="#chemistry">Chemistry</a>
            <a href="#history">History</a>
            <a href="#geography">Geography</a>
            <a href="#civics">Civics</a>
            <a href="#economics">Economics</a>
        </div>
    </div>
    <div class="dropdown">
        <span> <li><a href="grade12.php">Grade 12</a></li></span>
        <div class="dropdown-content">
            <a href="#mathematics">Mathematics</a>
            <a href="#biology">Biology</a>
            <a href="#physics">Physics</a>
            <a href="#chemistry">Chemistry</a>
            <a href="#history">History</a>
            <a href="#geography">Geography</a>
            <a href="#civics">Civics</a>
            <a href="#economics">Economics</a>
            <a href="#university_entrance_exam">University Entrance Exam</a>
        </div>
    </div>
    <div class="dropdown">
        <span><li><a href="department.php">Department</a></li></span>
        <div class="dropdown-content">
            <a href="#software">Software Engineering</a>
            <a href="#computer_science">Computer Science</a>
            <a href="#system">Information System</a>
            <a href="#technology">Information Technology</a>
            <a href="#freshman">Freshman Program</a>
        </div>
    </div>
                <li><a href="user_page.php"><button style="width:90px; height:40px; margin-top:-10px; color: #fff; background-color:#5bbdd8">COMMENT</button></a></a></li>
            </ul>
            <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        </nav>
    </header>
    <script>
    function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.classList.toggle('active');
}
    </script>
    <pre>



    </pre>
    <h1 style="text-align: center;">DIFFERENT DEPARTMENT MATERALS</h1><hr>
    <div class="gallery-containered">
    <div class="gallery">
        <!-- Software Engineering Section -->
        <div class="gallery-item">
            <h2 id="software" style="text-shadow: 1px 0 15px #000000;">SOFTWARE ENGINEERING DIFFERENT COURSE PDF</h2>
            <?php
            @include 'config.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadMaths'])) {
                $file = $_FILES['pdfUploadMaths'];
                $targetDir = "uploads/"; 
                $targetFile = $targetDir . basename($file["name"]);
                $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                if ($fileType == "pdf") {
                    // Move the uploaded file to the server's upload directory
                    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                        // Insert file information into the software_files database table
                        $stmt = $conn->prepare("INSERT INTO software_files (file_name, file_path) VALUES (?, ?)"); 
                        $stmt->bind_param("ss", $file["name"], $targetFile);
                        if ($stmt->execute()) {
                            echo "Software Engineering file uploaded and inserted successfully!";
                        } else {
                            echo "Error: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        echo "Failed to upload the file.";
                    }
                } else {
                    echo "Only PDF files are allowed for Software Engineering.";
                }
            }

            // Query to retrieve the list of uploaded PDF files
            $query = "SELECT * FROM software_files";  
            $result = $conn->query($query);
            ?>

            <h2>Software Engineering PDF</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="pdfUploadMaths" accept="application/pdf" required>
                <button type="submit">Upload</button>
            </form>

            <?php
            if ($result->num_rows > 0) {
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    $fileName = htmlspecialchars($row['file_name']);
                    $filePath = htmlspecialchars($row['file_path']);
                    echo "<li>";
                    echo "<a href='$filePath' target='_blank'>$fileName</a>";
                    echo " <a href='$filePath' download><button>Download</button></a>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "No PDF files found for Software Engineering.";
            }

            $conn->close();
            ?>
        </div>

        <!-- Computer Science Section -->
        <div class="gallery-item">
            <h2 id="computer_science" style="text-shadow: 1px 0 15px #000000;">COMPUTER SCIENCE DIFFERENT COURSE PDF</h2> 
            <?php
            @include 'config.php';  // Assuming config.php has your database connection

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadCiv'])) {
                $file = $_FILES['pdfUploadCiv'];
                $targetDir = "uploads/"; 
                $targetFile = $targetDir . basename($file["name"]);
                $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Check if the uploaded file is a PDF
                if ($fileType == "pdf") {
                    // Move the uploaded file to the server's upload directory
                    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                        // Insert file information into the computer_files database table
                        $stmt = $conn->prepare("INSERT INTO computer_files (file_name, file_path) VALUES (?, ?)"); 
                        $stmt->bind_param("ss", $file["name"], $targetFile);
                        if ($stmt->execute()) {
                            echo "Computer Science PDF file uploaded and inserted successfully!";
                        } else {
                            echo "Error: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        echo "Failed to upload the file.";
                    }
                } else {
                    echo "Only PDF files are allowed for Computer Science.";
                }
            }

            // Query to retrieve the list of uploaded PDF files
            $query = "SELECT * FROM computer_files";   
            $result = $conn->query($query);
            ?>

            <h2>Computer Science PDF</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="pdfUploadCiv" accept="application/pdf" required>
                <button type="submit">Upload</button>
            </form>

            <?php
            if ($result->num_rows > 0) {
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    $fileName = htmlspecialchars($row['file_name']);
                    $filePath = htmlspecialchars($row['file_path']);
                    echo "<li>";
                    echo "<a href='$filePath' target='_blank'>$fileName</a>";
                    echo " <a href='$filePath' download><button>Download</button></a>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "No Computer Science PDF files found.";
            }

            $conn->close();
            ?>
        </div>
        <!-- Software Engineering Section -->
        <div class="gallery-item">
    <h2 id="system" style="text-shadow: 1px 0 15px #000000;">INFORMATION SYSTEM DIFFERENT COURSE PDF</h2>
    <?php
    @include 'config.php'; // Assuming config.php has your database connection

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadSystem'])) {
        $file = $_FILES['pdfUploadSystem'];
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($file["name"]);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if ($fileType == "pdf") {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                $stmt = $conn->prepare("INSERT INTO system_files (file_name, file_path) VALUES (?, ?)");
                $stmt->bind_param("ss", $file["name"], $targetFile);
                if ($stmt->execute()) {
                    echo "Information system file uploaded and inserted successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Failed to upload the file.";
            }
        } else {
            echo "Only PDF files are allowed for Information system.";
        }
    }

    // Query to retrieve the list of uploaded PDF files for Information System
    $query = "SELECT * FROM system_files";
    $result = $conn->query($query);
    ?>

    <h2>Information System PDF</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="pdfUploadSystem" accept="application/pdf" required>
        <button type="submit">Upload</button>
    </form>

    <?php
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            $fileName = htmlspecialchars($row['file_name']);
            $filePath = htmlspecialchars($row['file_path']);
            echo "<li>";
            echo "<a href='$filePath' target='_blank'>$fileName</a>";
            echo " <a href='$filePath' download><button>Download</button></a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "No PDF files found for Information System.";
    }

    $conn->close();
    ?>
</div>
<div class="gallery-item">
    <h2 id="technology" style="text-shadow: 1px 0 15px #000000;">INFORMATION TECHNOLOGY DIFFERENT COURSE PDF</h2>
    <?php
    @include 'config.php'; // Assuming config.php has your database connection

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadTechnology'])) {
        $file = $_FILES['pdfUploadTechnology'];
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($file["name"]);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if ($fileType == "pdf") {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                $stmt = $conn->prepare("INSERT INTO technology_files (file_name, file_path) VALUES (?, ?)");
                $stmt->bind_param("ss", $file["name"], $targetFile);
                if ($stmt->execute()) {
                    echo "Information technology file uploaded and inserted successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Failed to upload the file.";
            }
        } else {
            echo "Only PDF files are allowed for Information Technology.";
        }
    }

    // Query to retrieve the list of uploaded PDF files for Information Technology
    $query = "SELECT * FROM technology_files";
    $result = $conn->query($query);
    ?>

    <h2>Information Technology PDF</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="pdfUploadTechnology" accept="application/pdf" required>
        <button type="submit">Upload</button>
    </form>

    <?php
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            $fileName = htmlspecialchars($row['file_name']);
            $filePath = htmlspecialchars($row['file_path']);
            echo "<li>";
            echo "<a href='$filePath' target='_blank'>$fileName</a>";
            echo " <a href='$filePath' download><button>Download</button></a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "No PDF files found for Information Technology.";
    }

    $conn->close();
    ?>
</div>
<div class="gallery-item">
    <h2 id="freshman" style="text-shadow: 1px 0 15px #000000;">FRESHMAN PROGRAM DIFFERENT COURSE PDF</h2>
    <?php
    @include 'config.php'; // Assuming config.php has your database connection

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadFreshman'])) {
        $file = $_FILES['pdfUploadFreshman'];
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($file["name"]);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if ($fileType == "pdf") {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                $stmt = $conn->prepare("INSERT INTO freshman_files (file_name, file_path) VALUES (?, ?)");
                $stmt->bind_param("ss", $file["name"], $targetFile);
                if ($stmt->execute()) {
                    echo "Freshman program file uploaded and inserted successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Failed to upload the file.";
            }
        } else {
            echo "Only PDF files are allowed for Freshman Program.";
        }
    }

    // Query to retrieve the list of uploaded PDF files for Freshman Program
    $query = "SELECT * FROM freshman_files";
    $result = $conn->query($query);
    ?>

    <h2>Freshman Program PDF</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="pdfUploadFreshman" accept="application/pdf" required>
        <button type="submit">Upload</button>
    </form>

    <?php
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            $fileName = htmlspecialchars($row['file_name']);
            $filePath = htmlspecialchars($row['file_path']);
            echo "<li>";
            echo "<a href='$filePath' target='_blank'>$fileName</a>";
            echo " <a href='$filePath' download><button>Download</button></a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "No Freshman program PDF files found.";
    }

    $conn->close();
    ?>
</div>
</div>
</div>
    <style>
 .gallery-container{
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    align-items: center;
}
h1 {
    color: #0574a7;
    margin-bottom: 20px;
}
.gallery{
    display:grid;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 20px;
    margin: 0 auto;
}
.gallery-item{
    position: relative;
    overflow: hidden;
    border-radius:8px;
    box-shadow: none !important;
    transition: transform 0.3s ease-in-out;
    background-color: #fff;
}
button {
   margin-left: 10px;
   padding: 5px 10px;
   cursor: pointer;
   border-radius:5px;
   height:25px;
   margin:3px;
  background-color:green;
  color:#fff;
}
.gallery-item p{
    text-align: center;
}
.gallery-item video{
    width:300px;
    height:250px;
    margin-top:20px;
    transition: transform 0.3s ease-in-out;
}
header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color:rgb(0,0,0,0.7);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    z-index: 1000;
}
.logo span {
    font-size: 24px;
    font-weight: bold;
}
.vedio{
    display: flex;
}
nav {
    display: flex;
    align-items: center;
}
.menu {
    list-style: none;
    display: flex;
    margin-right:50px;
    height: 15px !important;
}

.menu li {
    margin-left: 20px;
}

.menu a {
    color: white;
    text-decoration: none;
    font-size: 18px;
}
.menu li a button{
    border-radius:5px;
}
.menu li a button:hover{
 background-color:rgb(243, 128, 20) !important;
color:red;
}
.menu li a:hover{
color: #06acac;
}

.menu-toggle {
    display: none;
    font-size: 30px;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
}
@media screen and (max-width: 768px){
    .menu {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 43px;
        left: 0;
        width:100%;
        background-color:rgb(0,0,0,0.7);
        padding: 10px 0;
    }
    .menu li {
        margin: 10px 0;
        text-align:center;
    }
    .menu-toggle {
        display: block;
        margin-right:25px;
        margin-top:-15px;
    }
    .menu.active {
        display:flex;
        height:100vh !important;
    }
    header{
        height: 40px;
    }
}

.dropdown {
    display: inline-block;
    position: relative;
}

.dropdown-content {
    display: none; /* Initially hide the dropdown content */
    position: absolute; /* Position below the trigger */
    background-color: #3498b3;
    min-width: 160px; /* Set the width of content*/
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1; /* Ensure it is above other page content */
     padding: 10px;
}

.dropdown:hover .dropdown-content {
    display: block; /* Show the dropdown when hovering */
}
 .dropdown-content a {
    display: block;
    padding: 5px;
    text-decoration: none;
    color: #333;
    border-bottom: 1px solid #e0e0e0;
 }
  .dropdown-content a:hover{
     background-color: #e0e0e0;
 }

@media (max-width:768px){
    .gallery {
        grid-template-columns: repeat(2, 1fr) !important; /* 2 columns on smaller screens */
    }
}
@media (max-width: 480px) {
    .gallery {
        grid-template-columns: 1fr !important; /* 1 column on very small screens */
    }
}
    </style>
</body>
</html>
