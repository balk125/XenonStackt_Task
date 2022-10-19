<?php
require('connection.php');

session_start();

#for login
if(isset($_POST['login']))
{
    $query="SELECT * from `user_registration` where `email`='$_POST[email_username]' or `username`='$_POST[email_username]'";
    $result=mysqli_query($con,$query);


    if($result)
    {
            if(mysqli_num_rows($result)==1)
            {
                $result_fetch=mysqli_fetch_assoc($result); # fetch all data in associative array
                if(password_verify($_POST['password'],$result_fetch['password']))
                {
                   # chek database hash password and user password
                        $_SESSION['logged_in']=true;
                        $_SESSION['username']=$result_fetch['username'];
                        header("location: index.php");

                //    echo "right";
                }
                else{
                    echo" 
                    <script>
                    alert('Incorrect Password');
                    window.location.href='index.php';
                    </script>";

                }
            }
            else
            {
                echo" 
                <script>
                alert('Email or usernme not found');
                window.location.href='index.php';
                </script>";
            }
    }
    else
    {
        echo" 
        <script>
        alert('cannot login');
        window.location.href='index.php';
        </script>";
    }






}





# for registration
if (isset($_POST['register'])) // runs when reg button clicked
{
    $user_exist="SELECT * FROM `user_registration` where `username`='$_POST[username]' or `email`='$_POST[email]'";
    $result=mysqli_query($con,$user_exist);
    if($result){

        if(mysqli_num_rows($result)>0)
        {

            $result_fetch=mysqli_fetch_assoc($result);

            if($result_fetch['username']==$_POST['username'])
            {
                echo" 
                <script>
                alert(' $result_fetch[username] - username already exist');
                window.location.href='index.php';
                </script>"; 
            }
            else{
                echo" 
                <script>
                alert(' $result_fetch[email] - E-mail already exist');
                window.location.href='index.php';
                </script>"; 

            }

        }
        else # it will be executed if no one has taken username or email before
        {
            $password=password_hash($_POST['password'],PASSWORD_BCRYPT);

            $query="INSERT INTO `user_registration`(`full_name`, `username`, `email`, `password`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password')";

            if(mysqli_query($con,$query))
            {
                // if data inserted successfully

                echo" 
                <script>
                alert('Registration Successful');
                window.location.href='index.php';
                </script>";
            }
            else
            {
                echo" 
                <script>
                alert('data not  inserted ');
                window.location.href='index.php';
                </script>";
            }

        }


    }
    else{

        echo" 
        <script>
        alert('cannot Run query');
        window.location.href='index.php';
        </script>";
    }

}
