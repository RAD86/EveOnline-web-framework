<?php
session_start();
session_destroy();
die(header('location:index'));
?>