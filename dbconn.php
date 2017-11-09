<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "1234";
$dbname = "center_service";

$conn = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

//set encoding to utf8
$conn->query('SET character_set_client=utf8');
$conn->query('SET character_set_connection=utf8');
$conn->query('SET character_set_results=utf8');
