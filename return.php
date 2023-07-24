<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the input values from the form
  $renter_phone = $_POST['renter_phone'];
  $return_date = $_POST['return_date'];

  // Update the rental details in the database
  $conn = mysqli_connect('localhost', 'root', '', 'book_shop_db');
  if (!$conn) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
  }
  
  $sql = "UPDATE rentals SET return_date='$return_date' WHERE renter_phone='$renter_phone'";
  
  if (mysqli_query($conn, $sql)) {
    // Display success message
    echo "<div style='background-color: #dff0d8; padding: 10px;'>The book has been returned successfully.</div>";
  } else {
    echo "<div style='background-color: #f2dede; color: #a94442; padding: 10px;'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</div>";
  }
  
  mysqli_close($conn);
}
?>

<?php echo '<!DOCTYPE html>
<html>
  <head>
    <title>Return a Book</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
        margin: 0;
        padding: 0;
      }

      header {
        background-color: #333;
        color: #fff;
        padding: 20px;
      }

      h1 {
        margin-top: 0;
      }

      form {
        margin-top: 20px;
      }

      label {
        display: block;
        margin-bottom: 5px;
      }

      input[type="tel"],
      input[type="date"],
      input[type="submit"] {
        border: 1px solid #ccc;
        border-radius: 4px;
        font-family: Arial, sans-serif;
        font-size: 16px;
        padding: 10px;
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 10px;
      }

      input[type="submit"] {
        background-color: #333;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
      }

      input[type="submit"]:hover {
        background-color: #555;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Return a Book</h1>
    </header>
    <div style=\'max-width: 600px; margin: 0 auto;\'>
      <form method="post" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">
        <label for="renter_phone">Your Phone Number:</label>
        <input type="tel" id="renter_phone" name="renter_phone" required>
        <label for="return_date">Return Date:</label>
        <input type="date" id="return_date" name="return_date" required>
        <input type="submit" value="Return">
      </form>
    </div>
  </body>
</html>'; ?>
