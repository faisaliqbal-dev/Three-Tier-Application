<?php
// Database configuration
$dbHost = 'userdb.chwueygcg52w.us-east-1.rds.amazonaws.com';     // Your RDS endpoint
$dbUsername = 'admin';             // Your database username
$dbPassword = 'mdfaisal4257';     // Your database password
$dbName = 'userdb';                // Your database name

// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("<h2>Connection failed:</h2> " . $conn->connect_error . 
        "<br><br>Check: <br>1. Database credentials <br>2. RDS security group rules <br>3. If database 'userdb' exists");
} else {
    echo "<h2>Successfully connected to database 'userdb'!</h2>";
    
    // Test query
    $result = $conn->query("SHOW TABLES");
    if ($result) {
        echo "<h3>Tables in userdb:</h3>";
        while ($row = $result->fetch_array()) {
            echo "- " . $row[0] . "<br>";
        }
    } else {
        echo "<h3>No tables found in userdb</h3>";
    }
}

// Close connection
$conn->close();
?>