<?php
$conn = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_USERNAME);
// Check connection
if($conn === false){
	echo "Нет соединения";
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
mysqli_set_charset($conn , 'utf8' );

spl_autoload_register(function ($class_name) {
    include '../class/'.$class_name . '.php';
});


$conn_id = ftp_connect(FTP_SERVER) or die("Не удалось установить соединение с FTP_SERVER");

@$login_result = ftp_login($conn_id, FTP_USER, FTP_PASSWORD); 
ftp_pasv($conn_id, true);
if ((!$conn_id) || (!$login_result)) { 
        echo "Не удалось установить соединение с Интернет-сервером! <br> Добавление и редактирование заказов недоступны";
        echo "<br>Попытка подключения к серверу FTP_SERVER под именем FTP_USER!";
        exit; 
    } else {
        //echo "Соединение с веб-сервером установлено<br>";
    }
	




