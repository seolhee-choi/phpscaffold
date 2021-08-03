<?php
header('Access-Control-Allow-Origin : *');

$servername = "localhost";
$username = "root";
$password = "1111";
$dbname = "mocktest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT q.answer, c.id, c.choices FROM choice AS c JOIN quiz AS q WHERE q.answer=c.id";
$result = $conn->query($sql);
$result_array = array();

if ($result->num_rows > 0) {
  $result_array[$row];
  $temp_array = array();

  while ($row = $result->fetch_assoc()) {
    $one_array = array();
    $one_array["answer_no"] = $row["answer"];
    $one_array["choice_no"] = $row["id"];
    $temp_array["choices"][] = $one_array;
  }
  
}
$result_array['elements']=$temp_array;

echo json_encode([$result_array]);
$conn->close();
