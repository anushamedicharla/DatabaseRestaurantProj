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
            function addEmp()
            {
              $emplid = $_POST['emplid'];
              $position = $_POST['position'];
              $f_name = $_POST['f_name'];
              $l_name = $_POST['l_name'];
              $hno = $_POST['hno'];
              $street = $_POST['street'];
              $city = $_POST['city'];
              $state = $_POST['state'];
              $zip = $_POST['zip'];
              $email = $_POST['email'];
              $mobile = $_POST['mobile'];
              $salary = $_POST['salary'];
              $query = "INSERT INTO employee_data (empl_id,position,f_name,l_name,house_number,street,city,state,zip_code,email_id,mobile_number,salary)"
                      . " VALUES ('$emplid','$position','$f_name','$l_name','$hno','$street','$city','$state','$zip','$email','$mobile','$salary')"; 
              $data = mysql_query ($query) or die(mysql_error());
              if($data)
              {
                echo "<h1>New Employee ".$emplid." Added to the database...</h1>";
              }     
              else
              {      
                    echo "<h1>Add Employee Failed failed ! Try again later...</h1>";
                    echo "<a href=\"addEmployee.html\"> Re-Enter </a> ";  
              }
              
            }
            function check_emp()
            {
                if(!empty($_POST['emplid']) && !empty($_POST['position']) && !empty($_POST['f_name']) && !empty($_POST['l_name']) && !empty($_POST['hno']) && !empty($_POST['street']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip']) && !empty($_POST['email']) && !empty($_POST['mobile']) && !empty($_POST['salary']) )   //checking if all the fields from addEmployee.html are entered.
                {   
                    session_start();   //starting the session for user profile page 
                    $query = mysql_query("SELECT count(*) FROM employee_data WHERE empl_id = '$_POST[emplid]'") or die(mysql_error());
                        $row = mysql_fetch_array($query);
                        if( ($row[0]== 0) or die(mysql_error()))
                        {
                            addEmp();
                        }
                        else
                        {
                            echo "<h1>The Employee already exists in the database...</h1>";
                            echo "<a href=\"addEmployee.html\"> Enter new Employee </a> ";
                        }
                }
                else
                {
                    echo "<h1>Please enter all the requird fields</h1>";
                    echo "<a href=\"addEmployee.html\"> Re-Enter </a> ";
                }
            }
            
            if(isset($_POST['submit']))
            {
                check_emp();
            }
            
        ?>
    </body>
</html>