<?php
$host = 'localhost'; 
$user = 'root'; 
$pass = ''; 
$db = 'industria'; 

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}
echo "Conexão bem-sucedida!";
mysqli_close($conn);
?>
