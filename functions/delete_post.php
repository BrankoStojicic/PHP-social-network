<?php
$con = mysqli_connect("localhost","root","","parrot") 
    or die("Connection has not been established!");

if(isset($_GET['post_id'])){
    
    $post_id = $_GET['post_id']; 
    
    $delete_post = "delete from posts where post_id='$post_id'";
    
    $run_delete = mysqli_query($con,$delete_post);
    
    if($run_delete){
        echo "<script>alert('Your post has been deleted!')</script>";
        echo "<script>window.open('../home.php?u_id=$user_id','_self')</script>";
    }
    
}

?>