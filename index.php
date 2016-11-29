<?php
/* Attempt MySQL server connection.MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "022797Ceb", "co2_meter");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$temperature = mysqli_real_escape_string($link, $_POST['Temperature']);
$humidity = mysqli_real_escape_string($link, $_POST['Humidity']);
$co2 = mysqli_real_escape_string($link, $_POST['CO2']);

// if ((isset($_POST['humidity']))) 
// {
//     echo "POST";
// }

//Log contents of what was just added to database
$myfile = fopen("log.txt", "w") or die("Unable to open file!");
fwrite($myfile, print_r($_POST,true));
fwrite($myfile, print_r($_SERVER['REMOTE_ADDR'], true));
fclose($myfile);

// attempt insert query execution
$sql = "INSERT INTO vars (temp, humidity, co2) VALUES ('$temperature', '$humidity', '$co2')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>