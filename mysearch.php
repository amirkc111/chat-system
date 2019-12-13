<?php
include"db_connect.php";
  
$server_time=date("Y-m-d H:i:s");

if(isset($_POST['text'])){

$msg=mysqli_real_escape_string($db,$_POST["text"]);

$query=mysqli_query($conn,"SELECT * FROM question WHERE question RLIKE '[[:<:]]".$msg."[[:>:]]'");
$count = mysqli_num_rows($query);

    if($count=="0"){
      
        $data = "I am Sorry but I am not exactly clear how to help you";
        $query4=mysqli_query($conn,"insert into chats(user,chatbot,action,date)values('$msg','$data','text','$server_time')");
      
    }else{
        while($row = mysqli_fetch_array($query)){
              
                $data= $row['answer'];
                $action=$row['action'];
              
                $query4=mysqli_query($conn,"insert into chats(user,chatbot,action,date)values('$msg','$data','$action','$server_time')");
            }
        }
}  
?>
 