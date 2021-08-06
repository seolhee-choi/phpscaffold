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

$sql = "SELECT * FROM quiz";
$result = $conn->query($sql);
$result_array = array();

if ($result->num_rows > 0) {
  $result_array[$row];
  $temp_pages_array= array();
  
  while ($row = $result->fetch_assoc()) {
    $result_array["title"] = "대분류/중분류/소분류"; 

    $temp_array = array();
    $temp_array["type"] = "radiogroup";
    $temp_array["id"] = $row["id"];
    $temp_array["name"] = $row["id"];
    $temp_array["title"] = $row["title"];
    
    // $temp_array["expln"] = $row["expln"];
    // $temp_array["answer"] = $row["answer"];
    
    $sql2 = "SELECT * FROM choice where quiz_id='{$row["id"]}'";
    $result2 = $conn->query($sql2);
    $one_array= array();

    while ($row = $result2->fetch_assoc()) {
      $one_array["value"] = $row["id"];
      $one_array["text"] = $row["choices"];
      $temp_array['choices'][] = $one_array;
      
      //$temp_array["choices"][] = $row["choices"]; -이게 맞는것
      }
      
    $temp_pages_array['name']='page1';
    $temp_pages_array['elements'][] = $temp_array;
    
    // echo "<pre>";
    // var_dump($result_array);
    // echo "<pre>";

  }
  $result_array['pages'][] = $temp_pages_array;

} else {
  //   echo "0 results"; - 없어도됨
}

echo json_encode([$result_array]);
$conn->close();
