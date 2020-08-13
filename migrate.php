<?php
include 'commons_include.php';

connectDB();

$create_query = " CREATE TABLE subscribers (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR (150) UNIQUE NOT NULL
)";

$create_table = mysqli_query($mysqli, $create_query) or die(mysqli_error($mysqli));

echo 'Table created successfully!';