<?php
require('connection.php');
session_start();

if(isset($_POST['submit']))
{
    $query="INSERT INTO `contact_form`(`full_name`, `email`, `ph_number`, `country`, `subject`) VALUES ('$_POST[name]','$_POST[email]','$_POST[contact]','$_POST[country]','$_POST[subject]')  ";

    if(mysqli_query($con,$query))
            {
                echo" 
                <script>
                alert('Successful!! we will reach you soon Successful');
                window.location.href='index.php';
                </script>";
            }
            


}


?>