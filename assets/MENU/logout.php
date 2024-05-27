<?php
session_start();
session_unset();
session_destroy();
header('Location: ../../cambiar_pswd.php');
exit();
?>
