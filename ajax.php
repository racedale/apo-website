<?php
require_once 'mysql_access.php';

$response=mysql_query("SELECT id,question_name,answer FROM questions");
	 $i=1;
	 $right_answer=0;
	 $wrong_answer=0;
	 $unanswered=0;
	 while($result=mysql_fetch_array($response)){
	       if($result['answer']==$_POST["$i"]){
		       $right_answer++;
		   }else if($_POST["$i"]==5){
		       $unanswered++;
		   }
		   else{
		       $wrong_answer++;
		   }
		   $i++;
	 }
	 echo "<div id='answer'>";
	 echo " Right Answer  : <span class='highlight'>". $right_answer."</span><br>";

	 echo " Wrong Answer  : <span class='highlight'>". $wrong_answer."</span><br>";

	 echo " Unanswered Question  : <span class='highlight'>". $unanswered."</span><br>";
	 echo "</div>";
	 if ($right_answer >= $i) {
	 	$user_id = $_SESSION['sessionID'];
		$sql = "UPDATE `contact_information` SET `risk_management`=NOW() WHERE id='$user_id'";
		$result = mysql_query($sql);
		echo "<h2>You have passed the quiz!</h2>";
	 }


/*$limit=$_POST['question_num'];
//$limit1=$limit+1;
$response=mysql_query("select * from questions");


$data=array();
$data1=array();
while($result=mysql_fetch_array($response)){
$data['question_name']=$result['question_name'];
$data['answer1']=$result['answer1'];
$data['answer2']=$result['answer2'];
$data['answer3']=$result['answer3'];
$data['answer4']=$result['answer4'];
$data['answer']=$result['answer'];
$data['id']=$result['id'];
array_push($data1, $data);
$data="";
}
$a=json_encode($data1);
echo $a;*/
?>