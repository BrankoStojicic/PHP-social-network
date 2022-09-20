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
        <style>
            input[type='file']{width: 210px; position: relative; right: 5px;}
        </style>
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
                                    $user_pass = $row['user_pass'];
                                    $user_email = $row['user_email'];
                                    $user_country = $row['user_country'];
                                    $user_gender = $row['user_gender'];
                                    $user_image = $row['user_image'];
                                    $register_date = $row['register_date'];
                                    $last_login = $row['last_login'];
                                    echo 
"<img src='user/user_images/$user_image' width='200' height='200'>
 <div id='user_mention'>
    <p><strong>Name:</strong> $user_name</p>
    <p><strong>Surname:</strong> $user_surname</p>
    <p><strong>Country:</strong> $user_country</p>
    <p><strong>Last login:</strong> $last_login</p>
    <p><strong>Member since:</strong> $register_date</p>
    
    <a href='my_messages.php?u_id=$user_id'><p>Messages</p></a>
    <a href='my_posts.php?u_id=$user_id'><p>Posts</p></a>
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
                          
                               <div id="h2">
                               <h2>Edit your stuff!</h2>
                               </div>
                        <div id="userEdit">    
                       <form action="" method="post" id="f" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td align="right" colspan="2">Name:</td>
                                <td>
                                    <input type="text" name="username" value="<?php echo $user_name;?>" id="name">
                                    <input type="text" name="surname" value="<?php echo $user_surname;?>" id="surname">
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2">Password:</td>
                                <td><input type="password" name="pass" value="<?php echo $user_pass;?>"></td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2">E-mail:</td>
                                <td><input type="email" name="mail" value="<?php echo $user_email;?>"</td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2">Country:</td>
                                <td>
                            <select name="country" disabled="disabled">
    <option value="User"><?php echo $user_country;?></option>
    <option value="AF">Afghanistan</option>
    <option value="AX">Åland Islands</option>
	<option value="AL">Albania</option>
	<option value="DZ">Algeria</option>
	<option value="AS">American Samoa</option>
	<option value="AD">Andorra</option>
	<option value="AO">Angola</option>
	<option value="AI">Anguilla</option>
	<option value="AQ">Antarctica</option>
	<option value="AG">Antigua and Barbuda</option>
	<option value="AR">Argentina</option>
	<option value="AM">Armenia</option>
	<option value="AW">Aruba</option>
	<option value="AU">Australia</option>
	<option value="AT">Austria</option>
	<option value="AZ">Azerbaijan</option>
	<option value="BS">Bahamas</option>
	<option value="BH">Bahrain</option>
	<option value="BD">Bangladesh</option>
	<option value="BB">Barbados</option>
	<option value="BY">Belarus</option>
	<option value="BE">Belgium</option>
	<option value="BZ">Belize</option>
	<option value="BJ">Benin</option>
	<option value="BM">Bermuda</option>
	<option value="BT">Bhutan</option>
	<option value="BO">Bolivia, Plurinational State of</option>
	<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
	<option value="BA">Bosnia and Herzegovina</option>
	<option value="BW">Botswana</option>
	<option value="BV">Bouvet Island</option>
	<option value="BR">Brazil</option>
	<option value="IO">British Indian Ocean Territory</option>
	<option value="BN">Brunei Darussalam</option>
	<option value="BG">Bulgaria</option>
	<option value="BF">Burkina Faso</option>
	<option value="BI">Burundi</option>
	<option value="KH">Cambodia</option>
	<option value="CM">Cameroon</option>
	<option value="CA">Canada</option>
	<option value="CV">Cape Verde</option>
	<option value="KY">Cayman Islands</option>
	<option value="CF">Central African Republic</option>
	<option value="TD">Chad</option>
	<option value="CL">Chile</option>
	<option value="CN">China</option>
	<option value="CX">Christmas Island</option>
	<option value="CC">Cocos (Keeling) Islands</option>
	<option value="CO">Colombia</option>
	<option value="KM">Comoros</option>
	<option value="CG">Congo</option>
	<option value="CD">Congo, the Democratic Republic of the</option>
	<option value="CK">Cook Islands</option>
	<option value="CR">Costa Rica</option>
	<option value="CI">Côte d'Ivoire</option>
	<option value="HR">Croatia</option>
	<option value="CU">Cuba</option>
	<option value="CW">Curaçao</option>
	<option value="CY">Cyprus</option>
	<option value="CZ">Czech Republic</option>
	<option value="DK">Denmark</option>
	<option value="DJ">Djibouti</option>
	<option value="DM">Dominica</option>
	<option value="DO">Dominican Republic</option>
	<option value="EC">Ecuador</option>
	<option value="EG">Egypt</option>
	<option value="SV">El Salvador</option>
	<option value="GQ">Equatorial Guinea</option>
	<option value="ER">Eritrea</option>
	<option value="EE">Estonia</option>
	<option value="ET">Ethiopia</option>
	<option value="FK">Falkland Islands (Malvinas)</option>
	<option value="FO">Faroe Islands</option>
	<option value="FJ">Fiji</option>
	<option value="FI">Finland</option>
	<option value="FR">France</option>
	<option value="GF">French Guiana</option>
	<option value="PF">French Polynesia</option>
	<option value="TF">French Southern Territories</option>
	<option value="GA">Gabon</option>
	<option value="GM">Gambia</option>
	<option value="GE">Georgia</option>
	<option value="DE">Germany</option>
	<option value="GH">Ghana</option>
	<option value="GI">Gibraltar</option>
	<option value="GR">Greece</option>
	<option value="GL">Greenland</option>
	<option value="GD">Grenada</option>
	<option value="GP">Guadeloupe</option>
	<option value="GU">Guam</option>
	<option value="GT">Guatemala</option>
	<option value="GG">Guernsey</option>
	<option value="GN">Guinea</option>
	<option value="GW">Guinea-Bissau</option>
	<option value="GY">Guyana</option>
	<option value="HT">Haiti</option>
	<option value="HM">Heard Island and McDonald Islands</option>
	<option value="VA">Holy See (Vatican City State)</option>
	<option value="HN">Honduras</option>
	<option value="HK">Hong Kong</option>
	<option value="HU">Hungary</option>
	<option value="IS">Iceland</option>
	<option value="IN">India</option>
	<option value="ID">Indonesia</option>
	<option value="IR">Iran, Islamic Republic of</option>
	<option value="IQ">Iraq</option>
	<option value="IE">Ireland</option>
	<option value="IM">Isle of Man</option>
	<option value="IL">Israel</option>
	<option value="IT">Italy</option>
	<option value="JM">Jamaica</option>
	<option value="JP">Japan</option>
	<option value="JE">Jersey</option>
	<option value="JO">Jordan</option>
	<option value="KZ">Kazakhstan</option>
	<option value="KE">Kenya</option>
	<option value="KI">Kiribati</option>
	<option value="KP">Korea, Democratic People's Republic of</option>
	<option value="KR">Korea, Republic of</option>
	<option value="KW">Kuwait</option>
	<option value="KG">Kyrgyzstan</option>
	<option value="LA">Lao People's Democratic Republic</option>
	<option value="LV">Latvia</option>
	<option value="LB">Lebanon</option>
	<option value="LS">Lesotho</option>
	<option value="LR">Liberia</option>
	<option value="LY">Libya</option>
	<option value="LI">Liechtenstein</option>
	<option value="LT">Lithuania</option>
	<option value="LU">Luxembourg</option>
	<option value="MO">Macao</option>
	<option value="MK">Macedonia, the former Yugoslav Republic of</option>
	<option value="MG">Madagascar</option>
	<option value="MW">Malawi</option>
	<option value="MY">Malaysia</option>
	<option value="MV">Maldives</option>
	<option value="ML">Mali</option>
	<option value="MT">Malta</option>
	<option value="MH">Marshall Islands</option>
	<option value="MQ">Martinique</option>
	<option value="MR">Mauritania</option>
	<option value="MU">Mauritius</option>
	<option value="YT">Mayotte</option>
	<option value="MX">Mexico</option>
	<option value="FM">Micronesia, Federated States of</option>
	<option value="MD">Moldova, Republic of</option>
	<option value="MC">Monaco</option>
	<option value="MN">Mongolia</option>
	<option value="ME">Montenegro</option>
	<option value="MS">Montserrat</option>
	<option value="MA">Morocco</option>
	<option value="MZ">Mozambique</option>
	<option value="MM">Myanmar</option>
	<option value="NA">Namibia</option>
	<option value="NR">Nauru</option>
	<option value="NP">Nepal</option>
	<option value="NL">Netherlands</option>
	<option value="NC">New Caledonia</option>
	<option value="NZ">New Zealand</option>
	<option value="NI">Nicaragua</option>
	<option value="NE">Niger</option>
	<option value="NG">Nigeria</option>
	<option value="NU">Niue</option>
	<option value="NF">Norfolk Island</option>
	<option value="MP">Northern Mariana Islands</option>
	<option value="NO">Norway</option>
	<option value="OM">Oman</option>
	<option value="PK">Pakistan</option>
	<option value="PW">Palau</option>
	<option value="PS">Palestinian Territory, Occupied</option>
	<option value="PA">Panama</option>
	<option value="PG">Papua New Guinea</option>
	<option value="PY">Paraguay</option>
	<option value="PE">Peru</option>
	<option value="PH">Philippines</option>
	<option value="PN">Pitcairn</option>
	<option value="PL">Poland</option>
	<option value="PT">Portugal</option>
	<option value="PR">Puerto Rico</option>
	<option value="QA">Qatar</option>
	<option value="RE">Réunion</option>
	<option value="RO">Romania</option>
	<option value="RU">Russian Federation</option>
	<option value="RW">Rwanda</option>
	<option value="BL">Saint Barthélemy</option>
	<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
	<option value="KN">Saint Kitts and Nevis</option>
	<option value="LC">Saint Lucia</option>
	<option value="MF">Saint Martin (French part)</option>
	<option value="PM">Saint Pierre and Miquelon</option>
	<option value="VC">Saint Vincent and the Grenadines</option>
	<option value="WS">Samoa</option>
	<option value="SM">San Marino</option>
	<option value="ST">Sao Tome and Principe</option>
	<option value="SA">Saudi Arabia</option>
	<option value="SN">Senegal</option>
	<option value="RS">Serbia</option>
	<option value="SC">Seychelles</option>
	<option value="SL">Sierra Leone</option>
	<option value="SG">Singapore</option>
	<option value="SX">Sint Maarten (Dutch part)</option>
	<option value="SK">Slovakia</option>
	<option value="SI">Slovenia</option>
	<option value="SB">Solomon Islands</option>
	<option value="SO">Somalia</option>
	<option value="ZA">South Africa</option>
	<option value="GS">South Georgia and the South Sandwich Islands</option>
	<option value="SS">South Sudan</option>
	<option value="ES">Spain</option>
	<option value="LK">Sri Lanka</option>
	<option value="SD">Sudan</option>
	<option value="SR">Suriname</option>
	<option value="SJ">Svalbard and Jan Mayen</option>
	<option value="SZ">Swaziland</option>
	<option value="SE">Sweden</option>
	<option value="CH">Switzerland</option>
	<option value="SY">Syrian Arab Republic</option>
	<option value="TW">Taiwan, Province of China</option>
	<option value="TJ">Tajikistan</option>
	<option value="TZ">Tanzania, United Republic of</option>
	<option value="TH">Thailand</option>
	<option value="TL">Timor-Leste</option>
	<option value="TG">Togo</option>
	<option value="TK">Tokelau</option>
	<option value="TO">Tonga</option>
	<option value="TT">Trinidad and Tobago</option>
	<option value="TN">Tunisia</option>
	<option value="TR">Turkey</option>
	<option value="TM">Turkmenistan</option>
	<option value="TC">Turks and Caicos Islands</option>
	<option value="TV">Tuvalu</option>
	<option value="UG">Uganda</option>
	<option value="UA">Ukraine</option>
	<option value="AE">United Arab Emirates</option>
	<option value="GB">United Kingdom</option>
	<option value="US">United States</option>
	<option value="UM">United States Minor Outlying Islands</option>
	<option value="UY">Uruguay</option>
	<option value="UZ">Uzbekistan</option>
	<option value="VU">Vanuatu</option>
	<option value="VE">Venezuela, Bolivarian Republic of</option>
	<option value="VN">Viet Nam</option>
	<option value="VG">Virgin Islands, British</option>
	<option value="VI">Virgin Islands, U.S.</option>
	<option value="WF">Wallis and Futuna</option>
	<option value="EH">Western Sahara</option>
	<option value="YE">Yemen</option>
	<option value="ZM">Zambia</option>
	<option value="ZW">Zimbabwe</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2">Gender:</td>
                                <td>
                                    <select name="gender" id="gender" disabled="disabled">
                                        
                                        <option value="user"><?php echo $user_gender;?></option>
                                        <option value="male">Male</option>
                                        <option value="female">female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2">Change photo</td>
                                <td><input type="file" name="u_image" required="required"/></td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                   
                                    <input type="submit" name="update" value="Update">
                                    
                                </td>
                            </tr>
                        </table>
                    </form>
<?php
  if(isset($_POST['update'])){
      
      $u_name = $_POST['username'];
      $u_surname = $_POST['surname'];
      $u_pass = $_POST['pass'];
      $u_email = $_POST['mail'];
      $u_image = $_FILES['u_image']['name'];
      $image_tmp = $_FILES['u_image']['tmp_name'];
      
      move_uploaded_file($image_tmp,"user/user_images/$u_image");
      
      $update = "update users set user_name='$u_name', user_surname='$u_surname', user_pass='$u_pass', user_email='$u_email', user_image='$u_image' where user_id='$user_id'";
      
      $run = mysqli_query($con,$update);
      
      if($run){
          echo "<script>alert('Profile Updated')</script>";
          echo "<script>window.open('home.php','_self')</script>";
      }
      
  }      
        
?>
                            
                        </div>
                        <!--content timeline end-->
                    </div>
        </div>
        </div>
        <!--Container end-->
        
        
    </body>
   <?php include("template/footer.php"); ?>
</html>
<?php
    }
?>