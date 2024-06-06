<?php 

include 'connect.php';

if(isset($_POST['signup'])){
    $name=$_POST['name'];
    $pass=$_POST['pass'];
    $pass=md5($pass);

     $checkEmail="SELECT * From register where name ='$name'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "name Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO register(name,pass)
                       VALUES ('$name','$pass')";
            if($conn->query($insertQuery)==TRUE){
                header("location: lp.html");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
   $name=$_POST['name'];
   $pass=$_POST['pass'];
   $pass=md5($pass) ;
   
   $sql="SELECT * FROM register WHERE name='$name' and pass='$pass'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['name']=$row['name'];
    header("Location: homepage.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}
?>