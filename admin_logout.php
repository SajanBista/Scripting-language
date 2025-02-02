<?php

include '../include/connect.php';

session_start();
session_unset();
session_destroy();

echo "<script type='text/javascript'>
alert('Logged Out Succesful.')
window.location.href='admin_login.php';
</script>";
