<?php
session_start();

require 'src/auxiliar.php';

$_SESSION = [];
session_destroy();
volver();
