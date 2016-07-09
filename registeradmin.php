<html>
    <head>
        <title>Login Verification</title>
        <link rel="stylesheet" type="text/css" href ="validateLogin_style.css">
    </head>
    <body>
        <?php
            define('DB_HOST', 'mysql.cs.txstate.edu');
            define('DB_NAME', 'a_m725');
            define('DB_USER','a_m725');
            define('DB_PASSWORD','mysqldb');
            $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
            $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
            function RegisterAdmin()
            {
              $usernm = $_POST['username'];
              $emplid = $_POST['emplid'];
              $paswrd = $_POST['pswd'];
              $email  = $_POST['email'];
              $mobile = $_POST['mobile'];
              
              $query = "INSERT INTO admin (username,user_id,password,email_id,mobile_number) VALUES ('$usernm','$emplid','$paswrd','$email','$mobile')"; 
              $data = mysql_query ($query) or $error1 = mysql_error();//die(mysql_error());
              if($data)
              {
                echo "<h1>YOUR REGISTRATION IS COMPLETED...</h1>";
                echo "<a href=\"index.html\"> Login Here </a>"; 
              }     
              else
              {
                  echo substr($error1,0,64);
                if(substr($error1,0,64) == "Cannot add or update a child row: a foreign key constraint fails")
                {
                    echo "<h1>Invalid Employee ID...</h1>";
                }
      
                    echo "<h1>Registration failed ! Try again later...</h1>";
                    echo "<a href=\"newAdminRegistration.html\"> Enter new Username </a> ";  
              }
               
                
            }
            
            function SignUp()
            {
                if(!empty($_POST['username']) && !empty($_POST['emplid']) && !empty($_POST['pswd']) && !empty($_POST['cpswd']) && !empty($_POST['email']) && !empty($_POST['mobile']) )   //checking if all the fields from newAdminRegistration.html are entered.
                {   
                    session_start();   //starting the session for user profile page 
                    if(!empty($_POST['username']))   //checking the 'user' name which is from Sign-Up.html, is it empty or have some text
                    {
                        $query = mysql_query("SELECT count(*) FROM admin WHERE username = '$_POST[username]'") or die(mysql_error());
                        $row = mysql_fetch_array($query);
                        if( ($row[0]== 0) or die(mysql_error()))
                        {
                            RegisterAdmin();
                        }
                        else
                        {
                            echo "<h1>SORRY...YOU ARE ALREADY REGISTERED USER...</h1>";
                            echo "<a href=\"newAdminRegistration.html\"> Enter new Username </a> ";
                        }
                    }
                }
                else
                {
                    echo "<h1>Please enter all the requird fields</h1>";
                    echo "<a href=\"newAdminRegistration.html\"> Re-Enter </a> ";
                }
            }
            if(isset($_POST['submit']))
            {
                SignUp();
            }
        ?>
    </body>
</html>