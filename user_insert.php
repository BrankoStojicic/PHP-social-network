<?php
include("includes/connection.php");
        global $con;
        if(isset($_POST['signUp'])){
            
            $name = mysqli_real_escape_string($con,$_POST['username']);
            $surname = mysqli_real_escape_string($con,$_POST['surname']);
            $pass = mysqli_real_escape_string($con,$_POST['pass']);
            $email = mysqli_real_escape_string($con,$_POST['mail']);
            $country = mysqli_real_escape_string($con,$_POST['country']);
            $gender = mysqli_real_escape_string($con,$_POST['gender']);
            $dob = mysqli_real_escape_string($con,$_POST['dateOfBirth']);
            $status = "unverified";
            $posts = "No";
            
            $get_email = "select * from users where user_email='$email'";
            $run_email = mysqli_query($con,$get_email);
            $check = mysqli_num_rows($run_email);
            
            if($check==1){
                echo "<script>alert('That email is alredy registered please try with another one!')</script>";
                exit();
            }
            if(strlen($pass)<8){
                echo "<script>alert('Please enter a password that is longer than 8 characters!')</script>";
                exit();
            }
            else{
            
                $insert = "insert into users (user_name,user_surname,user_pass,user_email,user_country,user_gender,user_birthday,user_image,register_date,last_login,status,posts) values ('$name','$surname','$pass','$email','$country','$gender','$dob','default.jpg',NOW(),NOW(),'$status','$posts')";
                $run_insert = mysqli_query($con,$insert);
                
                    if($run_insert){
                        $_SESSION['user_email']=$email;
                        echo "<script>alert('You have registered sucssesfuly!')</script>";
/*before this there should be an email verification but because this is in localhost and i can't use php email service*/
                        echo "<script>window.open('home.php','_self')</script>";
                            
                            
                    }
            }
            
            
        }
    
	
?>