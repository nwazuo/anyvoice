<?php
include 'commons_include.php';

//empty email?
if (isset($_GET['email'])) {
    //connect to DB
    connectDB();

    //check that email is in list
    checkEmail($_GET['email']);

    //get number of results and do action
    if (mysqli_num_rows($check_res) < 1) {
        //free result from memory
        mysqli_free_result($check_res);

        //print failure message
        $display_block = "Couldn't find your address";
    } else {
        //get value of ID from result
        while ($row = mysqli_fetch_array($check_res)) {
            $id = $row['id'];
        }

        //unsubscribe the address
        $del_sql = "DELETE from subscribers WHERE id = " . $id;
        $del_res = mysqli_query($mysqli, $del_sql) or die(json_encode(['error' => mysqli_error($mysqli)]));
        $display_block = "You're unsubscribed";
    }
    mysqli_close($mysqli);
} else {
    $display_block = "No email specified!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="bootstrap.min.css" rel="stylesheet" />
  <title>SendMyMail</title>
</head>

<body>
  <div class="container">
    <h1 class="display-1"><?php echo $display_block; ?></h1>
    <small class="small">I apologise for not styling this, there was no time</small>
  </div>
</body>

</html>