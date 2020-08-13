<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

if (getenv("CLEARDB_DATABASE_URL") === false) {
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "anyvoice";
} else {
    $host = $url["host"];
    $user = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);
}