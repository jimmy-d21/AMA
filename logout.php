<?php
session_start();
session_destroy();
header("Location: /AMA/index.php");
exit();
?>