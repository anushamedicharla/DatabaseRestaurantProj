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
            function SignIn()
            {
                session_start();   //starting the session for user profile page
                if(!empty($_POST['username']))   //checking the 'user' name which is from Sign-In.html, is it empty or have some text
                {
                    $query = mysql_query("SELECT *  FROM admin where username = $_POST[username] AND password = '$_POST[password]'") or die(mysql_error());
                    $row = mysql_fetch_array($query) or die(mysql_error());

                    if(!empty($row['username']) AND !empty($row['password']))
                    {
                        //$_SESSION['username'] = $row['password'];
                        $query = mysql_query("SELECT * FROM employee_data where empl_id = $row[user_id]");
                        $row2 = mysql_fetch_array($query) or die(mysql_error());
                        echo "<h2 class =\"headstyle\">Welcome ".$row2['f_name']." !! </h2>";
                        echo "<div class =\"menu-wrap\">
                                <center>
                                <nav class = \"menu\">
                                <ul class = \"clearfix\">
                                    <li>
                                        <a href=\"#\">Employee<span class=\"arrow\">&#9660;</span></a>
                                            <ul class=\"sub-menu\">
                                                <li><a href=\"addEmployee.html\">Add Employee</a></li>
                                                <li><a href=\"#\">Add Employee Hours</a></li>
                                                <li><a href=\"#\">Show All Employees</a></li>
                                            </ul>
                                    </li>
                                    <li><a href=\"#\">Menu<span class=\"arrow\">&#9660;</span></a>
                                        <ul class=\"sub-menu\">
                                            <li><a href=\"#\">Add Menu Item</a></li>
                                            <li><a href=\"#\">Order Grocery</a></li>
                                            <li><a href=\"#\">Show All Menu Items</a></li>
                                        </ul>
                                    </li>
                                    <li><a href=\"#\">Kitchen<span class=\"arrow\">&#9660;</span></a>
                                        <ul class=\"sub-menu\">
                                            <li><a href=\"#\">Add Kiten Supply Item</a></li>
                                            <li><a href=\"#\">Order Supply Item</a></li>
                                            <li><a href=\"#\">Show All Kitchen Supplies</a></li>
                                        </ul>
                                    </li>
                                </ul>
                             </nav>
                             </center>
                             </div>
                             <br> <br> <br> <br>
                             <div class =\"img-heading\">
                                <img src =\"ba1.jpg\">
                            </div>";
                    }
                    else
                    {   
                        echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
                    }
                    }
            }
            if(isset($_POST['submit']))
            {
                SignIn();
            }



    mysql_close($db);


        ?>
    </body>
</html>    

