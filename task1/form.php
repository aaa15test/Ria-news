<?php
    if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['text']) && isset($_POST['email'])){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $text = $_POST['text'];
        $email = $_POST['email'];
        $file = $_POST['file'];
     
        $db_host = "localhost"; 
        $db_user = "user"; 
        $db_password = "123"; 
        $db_table = "mytable"; 
     
        $db = mysqli_connect($db_host, $db_user, $db_password) OR DIE("Не возможно создать соединение ");

        mysqli_select_db($db, "mytable");

        mysqli_query($db, "SET NAMES 'utf8'", MYSQLI_STORE_RESULT);
     
        $result = mysqli_query ($db, "INSERT INTO ".$db_table."table"." (name, surname, text, email, file) VALUES ('$name', '$surname', '$text', '$email', '$file')");

    }
?>

<html>
<head>
</head>
<body>
    <form method="POST" action="">
        <input name="name" type="text" placeholder="Имя"/> <br/> <br/>
        <input name="surname" type="text" placeholder="Фамилия"/> <br/> <br/>
        <input name="text" type="text" placeholder="Текст"/> <br/> <br/>
        <input name="email" type="text" placeholder="email"/> <br/> <br/>
        <input name="file" type="file" placeholder="Файл"/> <br/> <br/> <br/>
        <input type="submit" value="Отправить"/>
    </form>
</body>
</html>
