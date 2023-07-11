<?php ob_start(); ?>
<?php

$connection = mysqli_connect('localhost','root','','cms');

if($connection)
{
    echo "";
}
else
{
    echo "Not Connected";
}

?>