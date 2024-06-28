GNU nano 7.2 /home/akmal/cron-test/cron.php <?php
$con = mysqli_connect("172.31.176.1", "root", "", "cron");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$insert = "INSERT
INTO
  `test`
  (`info`)
VALUES
  ('masok')";

for($i = 0; $i < 6; $i++) {
    mysqli_query($con, $insert);
    sleep(10);
}

mysqli_close($con);
