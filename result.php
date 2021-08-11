<?php
//header('Content-Type: application/json');
//echo $_POST;
//print_r($_POST);


header('Access-Control-Allow-Origin : *');
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

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

//echo $_POST;
//채점쿼리!!!!!!!!!!!!!!!!!!!!!!!!!!
$json = file_get_contents('php://input');
$quizResult = json_decode($json);
// print_r($quizResult);
// echo $json;
// exit();

$check_array = array();

foreach($quizResult as $key => $item) {
  $sql3 = "SELECT * FROM quiz WHERE id = '$key'";
  $result3 = $conn->query($sql3);
  
  if($row = $result3 ->fetch_assoc()){
   if($row['answer'] === $item) { 
    //  $check_array[$key] = $row['id']."번 문제 : 정답";
    $check_array[$key] = 1;//정답
   } else {
    $check_array[$key] = 0;//틀림
   }   
  }
}
echo json_encode($check_array);
//echo json_encode($quizResult);
  
exit();

// $sql = "SELECT q.title, q.answer, c.id, c.choices FROM choice AS c JOIN quiz AS q";
$sql = "SELECT * FROM quiz";
$result = $conn->query($sql);
$result_array = array();

if ($result->num_rows > 0) {
  $result_array[$row];
  $temp_pages_array= array();
  
  while ($row = $result->fetch_assoc()) {

    $temp_array = array();
    $temp_array['question_no'] = $row['id'];
    $temp_array['question'] = $row['title'];
    $temp_array['answer_no'] = $row['answer'];


    $sql2 = "SELECT * FROM choice where quiz_id='{$row["id"]}'";
    $result2 = $conn->query($sql2);
    $one_array = array();
      while ($row = $result2->fetch_assoc()) {
        $one_array['value'] = $row['id'];
        $one_array['text'] = $row['choices'];
        $temp_array['choices'][] = $one_array;
    }
    $temp_pages_array['questions'][]=$temp_array;
  }
  // $result_array['elements'][]=$temp_pages_array;
  $result_array['elements']=$temp_pages_array;
} 
// echo json_encode([$result_array]);
echo json_encode($total_array);


$conn->close();
