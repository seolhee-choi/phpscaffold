<?php
//header('Content-Type: application/json');
//echo $_POST;
//print_r($_POST);


header('Access-Control-Allow-Origin : *');
header("Access-Control-Allow-Headers: *");
//header('Access-Control-Allow-Methods: *');


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


header('Content-Type: application/json');

//echo $_POST;
$json = file_get_contents('php://input');
$quizResult = json_decode($json);
var_dump(json_decode($json));
//채점쿼리
// function countValuesRecursive($array, $count = 0) {    
//   foreach ($array as $value) {
//        if (is_array($value)) {            
//             $count = countValuesRecursive($value, $count); 
//         } else {
//              if ($value) {
//                   $count++; 
//              } 
//         } 
//   } 
//   return $count; 
// } // end func

// $sql3 = "SELECT * FROM quiz";
// $result3 = $conn->query($sql3);
// $arr = array();
//   if ($result3->num_rows > 0) {
//     $arr[$row];
//     $row = $result3->fetch_assoc();
//       foreach($arr as $key => $value) {
//         if($value === $row['answer']) {
//         }
        
//       }
//   } 
  
//echo count($value);
//echo $arr;
exit();

//echo json_last_error_msg();
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


    //여기부터 채점쿼리
    // $sql3 = "SELECT c.id, q.answer, COUNT(*) FROM choice AS c JOIN quiz AS q where c.quiz_id=q.id 
    //           GROUP BY c.id,q.answer ORDER BY COUNT(*) DESC";
    // $sql3 = "SELECT c.id, q.answer FROM choice as c JOIN quiz as q ON c.id LIKE '{$row['id']}' WHERE c.quiz_id=q.id";
    // $result3 = $conn->query($sql3);
    // $total_array = array();
    //   while ($row = $result3->fetch_assoc()) {
    //       $two_array = array();
    //       $two_array['count'] = $row['count'];
    //       $two_array['value'] = $row['id'];
    //       $two_array['answer'] = $row['answer'];
    //   }
    //  $total_array[] = $two_array;
    }
    
    $temp_pages_array['questions'][]=$temp_array;
  }
  // $result_array['elements'][]=$temp_pages_array;
  $result_array['elements']=$temp_pages_array;
} 


// echo json_encode([$result_array]);
echo json_encode($total_array);




$conn->close();
