<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="styleweb.css">
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
            <a href="#computer">Computer Science</a>
            <a href="#information_system">Information System</a>
            <a href="#information_technology">Information Technology</a>
            <a href="#freshman_program">Freshman Program</a>
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
    <h1 style="text-align: center;">GRADE 10 MATERALS</h1><hr>
    <div class="gallery-containered">
    <div class="gallery">
        <div class="gallery-item">
            <div id="mathematics">
                <h1>Mathematics PDF</h1>  
                <?php
                @include 'config.php';

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadMaths'])) {
                    $file = $_FILES['pdfUploadMaths'];
                    $targetDir = "uploads/"; 
                    $targetFile = $targetDir . basename($file["name"]);
                    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                    if ($fileType == "pdf") {
                        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                            $stmt = $conn->prepare("INSERT INTO maths10_files (file_name, file_path) VALUES (?, ?)");
                            $stmt->bind_param("ss", $file["name"], $targetFile);
                            if ($stmt->execute()) {
                                echo "Maths file uploaded and inserted successfully!";
                            } else {
                                echo "Error: " . $stmt->error;
                            }
                            $stmt->close();
                        } else {
                            echo "Failed to upload the file.";
                        }
                    } else {
                        echo "Only PDF files are allowed for Maths.";
                    }
                }

                $query = "SELECT * FROM maths10_files"; 
                $result = $conn->query($query);
                ?>
                <h2>Upload PDF to Maths</h2>
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
                    echo "No PDF files found for Maths.";
                }

                $conn->close();
                ?>
            </div>
        </div>

        <div class="gallery-item">
            <div id="biology">
                <h1>Biology PDF</h1> 
                <?php
                @include 'config.php'; 

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadBio'])) {
                    $file = $_FILES['pdfUploadBio'];
                    $targetDir = "uploads/"; 
                    $targetFile = $targetDir . basename($file["name"]);
                    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                    if ($fileType == "pdf") {
                        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                            $stmt = $conn->prepare("INSERT INTO bio10_files (file_name, file_path) VALUES (?, ?)");
                            $stmt->bind_param("ss", $file["name"], $targetFile);
                            if ($stmt->execute()) {
                                echo "Biology PDF file uploaded and inserted successfully!";
                            } else {
                                echo "Error: " . $stmt->error;
                            }
                            $stmt->close();
                        } else {
                            echo "Failed to upload the file.";
                        }
                    } else {
                        echo "Only PDF files are allowed for Biology.";
                    }
                }

                $query = "SELECT * FROM bio10_files";  
                $result = $conn->query($query);
                ?>

                <h2>Upload Biology PDF</h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="file" name="pdfUploadBio" accept="application/pdf" required>
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
                    echo "No Biology PDF files found.";
                }

                $conn->close();
                ?>
            </div>
        </div>

        <div class="gallery-item">
            <div id="chemistry">
                <h1>Chemistry PDF</h1>
                <?php
                @include 'config.php';

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadChem'])) {
                    $file = $_FILES['pdfUploadChem'];
                    $targetDir = "uploads/"; 
                    $targetFile = $targetDir . basename($file["name"]);
                    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                    if ($fileType == "pdf") {
                        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                            $stmt = $conn->prepare("INSERT INTO chem10_files (file_name, file_path) VALUES (?, ?)");
                            $stmt->bind_param("ss", $file["name"], $targetFile);
                            if ($stmt->execute()) {
                                echo "Chemistry file uploaded and inserted successfully!";
                            } else {
                                echo "Error: " . $stmt->error;
                            }
                            $stmt->close();
                        } else {
                            echo "Failed to upload the file.";
                        }
                    } else {
                        echo "Only PDF files are allowed for Chemistry.";
                    }
                }

                $query = "SELECT * FROM chem10_files"; 
                $result = $conn->query($query);
                ?>

                <h2>Upload Chemistry PDF</h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="file" name="pdfUploadChem" accept="application/pdf" required>
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
                    echo "No Chemistry PDF files found.";
                }

                $conn->close();
                ?>
 
</div>
</div>
<div class="gallery-item">
    <div id="physics">
        <h1>Physics PDF</h1>
        <?php
        @include 'config.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadPhy'])) {
            $file = $_FILES['pdfUploadPhy'];
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($file["name"]);
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if ($fileType == "pdf") {
                if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                    $stmt = $conn->prepare("INSERT INTO phy10_files (file_name, file_path) VALUES (?, ?)");
                    $stmt->bind_param("ss", $file["name"], $targetFile);
                    if ($stmt->execute()) {
                        echo "Physics file uploaded and inserted successfully!";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Failed to upload the file.";
                }
            } else {
                echo "Only PDF files are allowed for Physics.";
            }
        }

        $query = "SELECT * FROM phy10_files"; 
        $result = $conn->query($query);
        ?>

        <h2>Upload Physics PDF</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="pdfUploadPhy" accept="application/pdf" required>
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
            echo "No Physics PDF files found.";
        }

        $conn->close();
        ?>
    </div>
</div>

<div class="gallery-item">
    <div id="history">
        <h1>History PDF</h1>
        <?php
        @include 'config.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadHisto'])) {
            $file = $_FILES['pdfUploadHisto'];
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($file["name"]);
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if ($fileType == "pdf") {
                if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                    $stmt = $conn->prepare("INSERT INTO histo10_files (file_name, file_path) VALUES (?, ?)");
                    $stmt->bind_param("ss", $file["name"], $targetFile);
                    if ($stmt->execute()) {
                        echo "History file uploaded and inserted successfully!";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Failed to upload the file.";
                }
            } else {
                echo "Only PDF files are allowed for History.";
            }
        }

        $query = "SELECT * FROM histo10_files"; 
        $result = $conn->query($query);
        ?>

        <h2>Upload History PDF</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="pdfUploadHisto" accept="application/pdf" required>
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
            echo "No History PDF files found.";
        }

        $conn->close();
        ?>
    </div>
</div>

<div class="gallery-item">
    <div id="geography">
        <h1>Geography PDF</h1>
        <?php
        @include 'config.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadGeo'])) {
            $file = $_FILES['pdfUploadGeo'];
            $targetDir = "uploads/"; 
            $targetFile = $targetDir . basename($file["name"]);
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if ($fileType == "pdf") {
                if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                    $stmt = $conn->prepare("INSERT INTO geo10_files (file_name, file_path) VALUES (?, ?)");
                    $stmt->bind_param("ss", $file["name"], $targetFile);
                    if ($stmt->execute()) {
                        echo "Geography file uploaded and inserted successfully!";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Failed to upload the file.";
                }
            } else {
                echo "Only PDF files are allowed for Geography.";
            }
        }

        $query = "SELECT * FROM geo10_files"; 
        $result = $conn->query($query);
        ?>

        <h2>Upload Geography PDF</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="pdfUploadGeo" accept="application/pdf" required>
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
            echo "No Geography PDF files found.";
        }

        $conn->close();
        ?>
    </div>
</div>

<div class="gallery-item">
    <div id="civics">
        <h1>Civics PDF</h1>
        <?php
        @include 'config.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadCiv'])) {
            $file = $_FILES['pdfUploadCiv'];
            $targetDir = "uploads/"; 
            $targetFile = $targetDir . basename($file["name"]);
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if ($fileType == "pdf") {
                if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                    $stmt = $conn->prepare("INSERT INTO civ10_files (file_name, file_path) VALUES (?, ?)");
                    $stmt->bind_param("ss", $file["name"], $targetFile);
                    if ($stmt->execute()) {
                        echo "Civics file uploaded and inserted successfully!";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Failed to upload the file.";
                }
            } else {
                echo "Only PDF files are allowed for Civics.";
            }
        }

        $query = "SELECT * FROM civ10_files"; 
        $result = $conn->query($query);
        ?>

        <h2>Upload Civics PDF</h2>
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
            echo "No Civics PDF files found.";
        }

        $conn->close();
        ?>
    </div>
</div>

<div class="gallery-item">
    <div id="economics">
        <h1>Economics PDF</h1>
        <?php
        @include 'config.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfUploadEco'])) {
            $file = $_FILES['pdfUploadEco'];
            $targetDir = "uploads/"; 
            $targetFile = $targetDir . basename($file["name"]);
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if ($fileType == "pdf") {
                if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                    $stmt = $conn->prepare("INSERT INTO eco10_files (file_name, file_path) VALUES (?, ?)");
                    $stmt->bind_param("ss", $file["name"], $targetFile);
                    if ($stmt->execute()) {
                        echo "Economics file uploaded and inserted successfully!";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Failed to upload the file.";
                }
            } else {
                echo "Only PDF files are allowed for Economics.";
            }
        }

        $query = "SELECT * FROM eco10_files"; 
        $result = $conn->query($query);
        ?>

        <h2>Upload Economics PDF</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="pdfUploadEco" accept="application/pdf" required>
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
            echo "No Economics PDF files found.";
        }

        $conn->close();
        ?>
    </div>
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
   margin: 3px;
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
/* Style dropdown links*/
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
