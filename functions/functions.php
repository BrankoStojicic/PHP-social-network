<?php

    $con = mysqli_connect("localhost","root","","parrot") 
    or die("Connection has not been established!");
// function for gettin' topics
function getTopics(){
    global $con;
    $get_topics = "select * from topics";
    $run_topics = mysqli_query($con,$get_topics);
                        
    while($row=mysqli_fetch_array($run_topics)){
        $topic_id = $row['topic_id'];
        $topic_title = $row['topic_title'];
                                
        echo "<option value='$topic_id'>$topic_title</option>";
                                
}
}
// function to inserting posts
function insertPost(){
        
        if(isset($_POST['submited'])){
            global $con;
            global $user_id;
            $title = addslashes($_POST['title']);
            $content = addslashes($_POST['content']);
            $topic = $_POST['topic'];
            
            if($content==''){
                echo "<h2>Please enter topic description</h2>";
                exit();
            }else{
            
            $insert = "INSERT INTO posts(user_id,topic_id,post_title,post_content,post_date)VALUES('$user_id','$topic','$title','$content',NOW())";
            $run = mysqli_query($con,$insert);
                if($run){
                    
                    
                    $update = "update users set posts='yes' where user_id='$user_id'";
                    $run_update = mysqli_query($con,$update);
                    header('location: home.php');
                }
            }
        }
        
    }
// function to displaying posts
function get_posts(){
    
    global $con;
    
    $per_page=5;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page=1;
    }
    $start_from = ($page-1) * $per_page;
    
    $get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";
    
    $run_posts = mysqli_query($con,$get_posts);
    
    while($row_posts=mysqli_fetch_array($run_posts)){
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];
        
        //getting the user who has posted the thread
        $user = "select * from users where user_id='$user_id' AND posts='yes'";
        
        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];
        
        // now displaying all at once
        echo "<div id='posts'>
        
        <p><img src='user/user_images/$user_image' width='50' height='50'></p>
        <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
        <h3>$post_title<h3>
        <h3>$post_date</h3>
        <p>$content</p>
        <a href='single.php?post_id=$post_id' style'float:right;'><button>See replies or Comment</button></a><br>
        
        
        </div><br>";
    }
    
    
    include("pagination.php");
}
//single post commenting
function single_post(){
    if(isset($_GET['post_id'])){
        global $con;
        $get_id = $_GET['post_id'];
        $get_posts = "select * from posts where post_id='$get_id'";
    
    $run_posts = mysqli_query($con,$get_posts);
    
   $row_posts=mysqli_fetch_array($run_posts);
        
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];
        
        //getting the user who has posted the thread
        $user = "select * from users where user_id='$user_id' AND posts='yes'";
        
        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];
       
        // getting user session
        $user_com = $_SESSION['user_email'];
        $get_com = "select * from users where user_email='$user_com'";
        $run_com = mysqli_query($con,$get_com);
        $row_com = mysqli_fetch_array($run_com);
        $user_com_id = $row_com['user_id'];
        $user_com_name = $row_com['user_name'];
        
        // now displaying all at once
        echo "<div id='posts'>
        
        <p><img src='user/user_images/$user_image' width='50' height='50'></p>
        <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
        <h3>$post_title<h3>
        <h3>$post_date</h3>
        <p>$content</p>
        ";
        include("comments.php");
        global $topic_id;
        echo"
        
        
        </div><br>
        <form id='reply' action='' method='post'>
        <textarea name='comment' cols='50' rows='5' placeholder='Your comment here...'></textarea><br>
        <div id='inreply'><input type='submit' name='reply' value='Reply to comment'><div>
        </form>
        </div>
        </div>
        ";
        if(isset($_POST['reply'])){
            
             
                
            
            $comment = $_POST['comment'];
            
            $insert = "insert into comments (post_id,user_id,comment,comment_author,date) values('$post_id','$user_id','$comment','$user_com_name',NOW())";
            
            $run = mysqli_query($con,$insert);
            
            echo "
            
            <br><div id='notifie'><p>Your comment was added!</p></div>";
                
                
            //header('location: home.php');
            
            
        }
    }
}

// function for getting categories and topics
function get_Cats(){
    
    global $con;
    
    $per_page=5;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page=1;
    }
    $start_from = ($page-1) * $per_page;
    
    if(isset($_GET['topic'])){
        $topic_id = $_GET['topic'];
    }
    
    $get_posts = "select * from posts where topic_id='$topic_id' ORDER by 1 DESC LIMIT $start_from, $per_page";
    
    $run_posts = mysqli_query($con,$get_posts);
    
    while($row_posts=mysqli_fetch_array($run_posts)){
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];
        
        //getting the user who has posted the thread
        $user = "select * from users where user_id='$user_id' AND posts='yes'";
        
        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];
        
        // now displaying all at once
        echo "<div id='posts'>
        
        <p><img src='user/user_images/$user_image' width='50' height='50'></p>
        <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
        <h3>$post_title<h3>
        <h3>$post_date</h3>
        <p>$content</p>
        <a href='single.php?post_id=$post_id' style'float:right;'><button>See replies or Comment</button></a><br>
        
        
        </div><br>";
    }
    
    
    include("pagination.php");
}


// function for getting search results
function get_results(){
    
    global $con;
    
    if(isset($_GET['user_query'])){
        $search_term = $_GET['user_query'];
    }
    
    $get_posts = "select * from posts where post_title LIKE '%$search_term%' OR post_content LIKE '%$search_term%' ORDER by 1 DESC LIMIT 5";
    
    $run_posts = mysqli_query($con,$get_posts);
    
    $count_result = mysqli_num_rows($run_posts);
    if($count_result==0){
        echo "<h3>Oh, shoot! Ummm... Well, this is embarrassing. How can I put this... Our best man are working on this, and believe me when I say, there may pass many winters, people may die. But! We will find what you are looking for!!!</h3>";
            exit();
    }
    
    while($row_posts=mysqli_fetch_array($run_posts)){
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];
        
        //getting the user who has posted the thread
        $user = "select * from users where user_id='$user_id' AND posts='yes'";
        
        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];
        
        // now displaying all at once
        echo "<div id='posts'>
        
        <p><img src='user/user_images/$user_image' width='50' height='50'></p>
        <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
        <h3>$post_title<h3>
        <h3>$post_date</h3>
        <p>$content</p>
        <a href='single.php?post_id=$post_id' style'float:right;'><button>See replies or Comment</button></a><br>
        
        
        </div><br>";
    }
    
    
   
}

// function for displaying posts
function user_posts(){
    
    global $con;
    if(isset($_GET['u_id'])){
        $u_id = $_GET['u_id'];
    }
    $get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 5";
    
    $run_posts = mysqli_query($con,$get_posts);
    
    while($row_posts=mysqli_fetch_array($run_posts)){
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];
        
        //getting the user who has posted the thread
        $user = "select * from users where user_id='$user_id' AND posts='yes'";
        
        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];
        
        // now displaying all at once
        echo "<div id='posts'>
        
        <p><img src='user/user_images/$user_image' width='50' height='50'></p>
        <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
        <h3>$post_title<h3>
        <h3>$post_date</h3>
        <p>$content</p>
        <a href='single.php?post_id=$post_id' style'float:right;'><button>View</button></a>
        <a href='edit_post.php?post_id=$post_id' style'float:right;'><button>Edit</button></a>
        <a href='functions/delete_post.php?post_id=$post_id' style'float:right;'><button>Delete</button></a><br>
    <FORM>
    <INPUT TYPE='button' onClick='history.go(0)' VALUE='Refresh posts'>
    </FORM>
        
        
        </div><br>";
        
        include("delete_post.php");
    }
    
    

}

?>