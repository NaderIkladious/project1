<?php

require 'db.php';
require 'functions.php';

$conn = connect($config);

if(!$conn) die('Could not connect.');