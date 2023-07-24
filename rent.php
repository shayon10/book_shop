<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the input values from the form
  $product_id = $_POST['product_id'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $renter_name = $_POST['renter_name'];
  $renter_address = $_POST['renter_address'];
  $renter_phone = $_POST['renter_phone'];

  // Calculate the rental cost
  $num_days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
  $rental_cost = 50 * $num_days;

  // Insert the rental details into the database
  $conn = mysqli_connect('localhost', 'root', '', 'book_shop_db');
  if (!$conn) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
  }
  
  $sql = "INSERT INTO rentals (product_id, start_date, end_date, renter_name, renter_address, renter_phone, rental_cost) VALUES ('$product_id', '$start_date', '$end_date', '$renter_name', '$renter_address', '$renter_phone', '$rental_cost')";
  
  if (mysqli_query($conn, $sql)) {
    // Display the rental cost
    echo "The cost of renting this book for $num_days days is $rental_cost taka.
    collect your book from the BookStore by showing the pdf of this page 
    to collect ur pdf press ctrl + p";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Rent a Book</title>
    <style>
      body {
        background-image: url('path/to/image.jpg');
        /* add any additional styling as needed */
      }

      h1 {
        margin-top: 50px;
        text-align: center;
        font-size: 36px;
        color: #333;
        text-shadow: 2px 2px #fff;
      }

      form {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        background-color: #fff;
      }

      label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #777;
      }

      input[type='text'],
      input[type='date'],
      input[type='tel'] {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: none;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        font-size: 16px;
        color: #333;
      }

      input[type='submit'] {
        background-color: #007bff;
        color: #fff;
        font-size: 18px;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
      }

      input[type='submit']:hover {
        background-color: #0056b3;
      }

      footer {
        text-align: center;
        font-size: 14px;
        color: #777;
        margin-top: 50px;
        padding-bottom: 20px;
      }
    </style>
  </head>
  <body>
    <h1>Rent a Book</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <label for="product_id">Product ID:</label>
      <input type="text" id="product_id" name="product_id">
      <label for="start_date">Start Date:</label>
      <input type="date" id="start_date" name="start_date">
      <label for="end_date">End Date:</label>
      <input type="date" id="end_date" name="end_date">
      <label for="renter_name">Your Name:</label>
      <input type="text" id="renter_name" name="renter_name">
      <label for="renter_address">Your Address:</label>
      <input type="text" id="renter_address" name="renter_address">
      <label for="renter_phone">Your Phone Number:</label>
      <input type="tel" id="renter_phone" name="renter_phone">
      <input type="submit" value="Rent">
    </form>
    <footer>&copy; 2023 by Shayon and Naim</footer>
  </body>
</html>




<?php
// Connect to the database
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'book_shop_db';

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve all products' names and IDs
$sql = "SELECT id, title FROM products";

$result = mysqli_query($conn, $sql);

// Table structure and styling
echo "<table style='border-collapse: collapse; width: 100%;'>";
echo "<thead><tr style='background-color: #eee;'><th style='padding: 10px 5px; border: 1px solid #ddd;'>Product ID</th><th style='padding: 10px 5px; border: 1px solid #ddd;'>Product Name</th></tr></thead>";
echo "<tbody>";

// Loop through the result set and output data
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr style='border: 1px solid #ddd;'>";
    echo "<td style='padding: 10px 5px; border: 1px solid #ddd; font-weight: bold;'>" . $row['id'] . "</td>";
    echo "<td style='padding: 10px 5px; border: 1px solid #ddd; font-style: italic;'>" . $row['title'] . "</td>";
    echo "</tr>";
}

// Close the table
echo "</tbody></table>";

// Free result set
mysqli_free_result($result);

// Close the connection
mysqli_close($conn);
?>