<!DOCTYPE html>
<html>
<?php
    if (session_status() === PHP_SESSION_NONE){ session_start(); }
    require_once 'pub/lib/ess.debug.php';
    require_once 'app/init.php';

    $app = new App;

?>
</html>