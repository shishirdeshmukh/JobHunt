<?php
function displayErrorMessage($message) {
    echo "<div class='message'>$message</div>";
    echo "<script>
              setTimeout(function() {
                  window.location.href = 'upload.html';
              }, 5000); // Wait for 5 seconds
          </script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $targetDir = "uploads/"; // Change this directory as needed
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Generate the CSS for background gradient
    $backgroundCSS = "
        <style>
            body {
                background: #bdc3c7;
                background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7);
                background: linear-gradient(to right, #2c3e50, #bdc3c7);
                font-family: Arial, sans-serif;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                margin: 0;
            }
            .message {
                background-color: white;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
                text-align: center;
                font-size: 18px;
            }
        </style>
    ";

    echo $backgroundCSS;

    // Check if file already exists
    if (file_exists($targetFile)) {
        displayErrorMessage("Sorry, file already exists.");
    }

    // Check file size (2MB)
    if ($_FILES["file"]["size"] > 2 * 1024 * 1024) {
        displayErrorMessage("Sorry, your file is too large.");
    }

    // Allow only specific file types
    $allowedTypes = array("doc", "docx", "pdf", "rtf");
    if (!in_array($imageFileType, $allowedTypes)) {
        displayErrorMessage("Sorry, only DOC, DOCX, PDF, and RTF files are allowed.");
    }

    // ... rest of your existing PHP code ...

    if ($uploadOk == 0) {
        displayErrorMessage("Sorry, your file was not uploaded.");
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            displayErrorMessage("The file " . basename($_FILES["file"]["name"]) . " has been uploaded to the 'uploads' folder.");
        } else {
            displayErrorMessage("Sorry, there was an error uploading your file.");
        }
    }
}
?>
