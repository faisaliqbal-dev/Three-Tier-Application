<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Database configuration
$dbHost = 'userdb.chwueygcg52w.us-east-1.rds.amazonaws.com';
$dbUsername = 'admin';
$dbPassword = 'mdfaisal4257';
$dbName = 'userdb';

// S3 configuration
$s3Bucket = 'ec2-form-photos';
$awsRegion = 'us-east-1';

// Initialize variables
$error = '';
$success = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Connect to database
        $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        
        if ($conn->connect_error) {
            throw new Exception("Database connection failed: " . $conn->connect_error);
        }
        
        // Get form data
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $address = $conn->real_escape_string($_POST['address']);
        
        // Handle file upload
        $photoUrl = '';
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $s3 = new S3Client([
                'version' => 'latest',
                'region'  => $awsRegion
            ]);
            
            $fileName = uniqid() . '_' . basename($_FILES['photo']['name']);
            $filePath = $_FILES['photo']['tmp_name'];
            
            try {
                $result = $s3->putObject([
                    'Bucket' => $s3Bucket,
                    'Key'    => $fileName,
                    'SourceFile' => $filePath,
                    'ACL'    => 'private'
                ]);
                
                $photoUrl = $result['ObjectURL'];
            } catch (AwsException $e) {
                throw new Exception("File upload failed: " . $e->getMessage());
            }
        }
        
        // Insert data into database
        $sql = "INSERT INTO form_submissions (name, email, phone, address, photo_url) 
                VALUES ('$name', '$email', '$phone', '$address', '$photoUrl')";
        
        if (!$conn->query($sql)) {
            throw new Exception("Database error: " . $conn->error);
        }
        
        $success = "Form submitted successfully!";
        $conn->close();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"], input[type="file"], textarea { 
            width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; 
        }
        button { background: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #45a049; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>Cloud Form Submission</h1>
    
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Full Name*</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email*</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone">
        </div>
        
        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" rows="3"></textarea>
        </div>
        
        <div class="form-group">
            <label for="photo">Upload Photo</label>
            <input type="file" id="photo" name="photo" accept="image/*">
        </div>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>