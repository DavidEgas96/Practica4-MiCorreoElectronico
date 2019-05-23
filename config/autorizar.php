<?php
if (isLoggedInUser()) readfile('static-files/'.$_REQUEST['file']);
else echo 'denied';
?>