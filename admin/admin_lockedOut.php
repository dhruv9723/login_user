<?php include ""; ?>
    <?php
    if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
        {
            echo "<p>Thanks for logging in <b>".$_SESSION['FName']." ".$_SESSION['SName']."</b>.</p>";
            echo "<a href='CareMarkLogout.php'><input name='logoutBtn' type='submit' value='Logout'/></a>";
            #set failed_login_attempts = 0
            $set_failed_login_attempts=mysql_query("UPDATE login SET failed_login_attempts=0 WHERE LoginID=".$_SESSION['LoginID']);

        }
        elseif(!empty($_POST['username']) && !empty($_POST['password']))
        {
            $userID = mysql_real_escape_string($_POST['username']);
            $password = md5(mysql_real_escape_string($_POST['password']));

            $checkloginEmp = mysql_query("SELECT * FROM UserDetails WHERE UserID = '".$userID."' AND Password = '".$password."'") or die(mysql_error());

            if(mysql_num_rows($checkloginEmp) == 1)
            {
                $row = mysql_fetch_array($checkloginEmp);
                $_SESSION['Username'] = $userID;
                $_SESSION['FName'] = $row['FName'];
                $_SESSION['SName'] = $row['SName'];
                $_SESSION['LoggedIn'] = 1;


                echo "<meta http-equiv='refresh' content='1;CareMarkLogin2.php'/>";
            }
            else
            {
                if (isset($_SESSION['LoggedAttempts'])){
                    $_SESSION['LoggedAttempts']++;
                }
                else{
                    $_SESSION['LoggedAttempts'] = 0;
                }

                $login = mysql_query("SELECT failed_login_attempts, last_failed_login FROM login WHERE LoginID ='".$_SESSION['LoginID']."'")or die(mysql_error());

                if(mysql_num_rows($login) == 0){

                    #create failed_login_attempts = failed_login_attempts + 1 AND last_failed_login = NOW()
                    $failed_login_attempts=mysql_query("INSERT INTO login VALUES ('','".$_SESSION['LoggedAttempts']."',NOW())");
                }

                else{
                    $row = mysql_fetch_array($login);
                    $_SESSION['LoginID'] = $row['LoginID'];
                    $update_failed_login_attempts=mysql_query("UPDATE login SET failed_login_attempts='".$_SESSION['LoggedAttempts']."',
                    last_failed_login = NOW() WHERE LoginID ='".$_SESSION['LoginID']."'") or die(mysql_error());
                }
            }


                $login_attempts_remaining=2 - $_SESSION['LoggedAttempts'];

                if ($login_attempts_remaining<=0){
                    echo 'Locked out!';
                    //going to add code here after to check if they were locked out for more than 10 minutes then to set failed login attempts back to zero
                }
                else{

                echo "Login Details Incorrect<p></p><p></p>";
                echo "<p>Please try again or contact head office on 091 771705</p>
                      <p>You have ". $login_attempts_remaining ." login attempts remaining. </p>
                      <p> <form action='CareMarkLogin2.php' method='POST'>
                            <input type='submit' name='login' id='login' value='Try again'/>
                          </form>
                      </p>";
                }
        }
        //}

    else{

        ?>
        <div id="mainText" style="width:400px;text-align:center;float:left" class="post">
            <form method="post" action="CareMarkLogin2.php" name="loginform" id="loginform">
                <fieldset>
                    <label for="username">Username:</label>
                        <input type="text" name="username" id="username"/><br/><br/>
                    <label for="password">Password:</label>
                        <input type="password" name="password" id="password"/><br/><br/>
                    <input type="submit" name="login" id="login" value="Login"/>
                </fieldset>
            </form>
        </div>
        <?php
        }
        ?>
