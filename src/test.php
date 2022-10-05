<?php
$host = 'db';

// Database user name
$user = getenv('MYSQL_USER', true) ?: getenv('MYSQL_USER');

//user password
$pass = getenv('MYSQL_PASSWORD', true) ?: getenv('MYSQL_PASSWORD');

//database name
$dbname = "myDB";

// check the MySQL connection status
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//insert data into the table
$sql = "INSERT INTO events (name, date)
VALUES ('event1', '2020-01-01')";
$sql .= ", ('event2', '2020-02-02')";
$sql .= ", ('event3', '2020-03-03')";
$sql .= ", ('event4', '2020-04-04')";

if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully";
    echo "<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//select data from the table
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

//display the data
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["date"]. "<br>";
  }
} else {
  echo "0 results";
}

//close the connection
mysqli_close($conn);
?>