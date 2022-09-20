<?php
    session_start();
    include("includes/connection.php");
    include("functions/functions.php");

    if(!isset($_SESSION['user_email'])){
        
        header("location: index.php");
    }else{
        
    
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Welcome User</title>
        <link rel="stylesheet" href="styles/home_style.css" media="all">
    </head>
    
    <body>
        <!--Container start-->
        <div class="container">
           <!--head wrap start-->
            <div id="head_wrap">
               <!--header start-->
                <div id="header">
                    <ul id="menu">
                        <li><a href="home.php"><img src="images/logo.png" alt="logo_bird"></a></li>
                        <li><a href="members.php">Members</a></li>
                        <strong>Topics:</strong>
                        <?php
                            $get_topics = "select * from topics";
                            $run_topics = mysqli_query($con,$get_topics);
                        
                            while($row=mysqli_fetch_array($run_topics)){
                                
                                $topic_id = $row['topic_id'];
                                $topic_title = $row['topic_title'];
                                
                echo "<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";
                                
                            }
                        ?>
                        
                    </ul>
                    
                    <form method="get" action="results.php" id="form1">
                        <input type="text" name="user_query" placeholder="...">
                        <input type="submit" name="search" value="Search">
                    </form>
                   
                </div>
                <!--header end-->
            </div>
            <!--head wrap end-->
             <!--content start-->
                    <div class="content">
                       <!--user timeline start-->
                        <div id="user_timeline">
                            <div id="user_details">
<?php
       $user = $_SESSION['user_email'];
       $get_user = "select * from users where user_email='$user'";
       $run_user = mysqli_query($con,$get_user);
       $row = mysqli_fetch_array($run_user);
       $user_id = $row['user_id'];
       $user_name = $row['user_name'];
       $user_surname = $row['user_surname'];
       $user_country = $row['user_country'];
       $user_image = $row['user_image'];
       $register_date = $row['register_date'];
       $last_login = $row['last_login'];
        
        $user_posts = "select * from posts where user_id='$user_id'";
        $run_posts = mysqli_query($con,$user_posts);
        $posts = mysqli_num_rows($run_posts);
echo 
"<img src='user/user_images/$user_image' width='200' height='200'>
 <div id='user_mention'>
    <p><strong>Name:</strong> $user_name</p>
    <p><strong>Surname:</strong> $user_surname</p>
    <p><strong>Country:</strong> $user_country</p>
    <p><strong>Last login:</strong> $last_login</p>
    <p><strong>Member since:</strong> $register_date</p>
    
    <a href='my_messages.php?u_id=$user_id'><p>Messages</p></a>
    <a href='my_posts.php?u_id=$user_id'><p>Posts ($posts)</p></a>
    <a href='edit_profile.php?u_id=$user_id'><p>Profile</p></a>
    <a href='logout.php'>
    <p>Logout</p></a>
 </div>";
                                ?>
                            </div>
                        </div>
                        <!--user timeline end-->
                        <!--content timeline start-->
                        <div id="content_timeline">
                          <div id="frame">
                          
                <div id="h2"><h2>Your posts</h2></div>
                            
                                <?php user_posts(); ?>
                            
                              
                        </div>
                        <!--content timeline end-->
                    </div>
        </div>
        <!--Container end-->
        
        
    </body>
   <?php include("template/footer.php"); ?>
</html>
<?php
    }
?>