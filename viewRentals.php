<?php
//database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_shop_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the rentals table
$sql = "SELECT r.id, p.name as product_name, r.start_date, r.end_date, r.date_created, r.renter_name, r.renter_address, r.renter_phone, r.rental_cost FROM rentals r JOIN products p ON r.product_id = p.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
        echo "Product Name: " . $row["product_name"] . "<br>";
        echo "Start Date: " . $row["start_date"] . "<br>";
        echo "End Date: " . $row["end_date"] . "<br>";
        echo "Date Created: " . $row["date_created"] . "<br>";
        echo "Renter Name: " . $row["renter_name"] . "<br>";
        echo "Renter Address: " . $row["renter_address"] . "<br>";
        echo "Renter Phone: " . $row["renter_phone"] . "<br>";
        echo "Rental Cost: $" . $row["rental_cost"] . "<br><br>";
    }
} else {
    echo "No results found.";
}
$conn->close();
?>
