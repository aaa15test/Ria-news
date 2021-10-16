<?php
if (isset($_POST['author_name']) && isset($_POST['author_surname']) && isset($_POST['book_name'])){
$author_name = $_POST['author_name'];
$author_surname = $_POST['author_surname'];
$book_name = $_POST['book_name'];

$host = 'localhost'; // адрес сервера 
$database = 'library'; // имя базы данных
$user = 'root'; // имя пользователя
$password = '12345'; // пароль
 
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_connect_error($link));

//Добавление книги и автора
$result = mysqli_query($link, "INSERT INTO author (author_surname,author_name) VALUES ('$author_surname','$author_name')");

$res=mysqli_query($link, "SHOW TABLE STATUS LIKE 'author'");
$row=mysqli_fetch_assoc($res);
$ida = $row['Auto_increment'];

$result1 = mysqli_query($link, "INSERT INTO book (book_name) VALUES ('$book_name')");

$resb=mysqli_query($link, "SHOW TABLE STATUS LIKE 'book'");
$rowb=mysqli_fetch_assoc($resb);
$id_b = $rowb['Auto_increment'];

$result3 = mysqli_query($link, "INSERT INTO book_author (books,authors) VALUES ('$id_b', '$ida')");

//поиск книги
if(isset($_POST['search_q'])) {
    $search_q=$_POST['search_q'];
    if(!empty($search_q)) {
        $q = mysqli_query($link, "SELECT * FROM book WHERE book_name LIKE '%$search_q%'");

        $itog = mysqli_fetch_assoc($q);
        $itogid = $itog["book_id"];
        $qa = mysqli_query($link, "SELECT authors FROM book_author WHERE books LIKE '$itogid'");
        $qa1 = mysqli_fetch_assoc($qa);
        $aut = $qa1["authors"];
        $qaa = mysqli_query($link, "SELECT * FROM author WHERE author_id LIKE '$aut'");
        $qwe = $qaa->fetch_assoc();
        printf("Книга '%s', автор %s %s.\n", $search_q, $qwe['author_name'], $qwe['author_surname']);  
    }
}

//поиск книги с фильтром по автору
if(isset($_POST['filter'], $_POST['id_prof'])) {
    $r = (int)$_POST['id_prof'];
    $sql1 = mysqli_query($link, "SELECT * FROM book_author WHERE authors LIKE '$r'");
    $cnt_row = mysqli_num_rows($sql1);
    printf("Найдено книг %d, книги:\n", $cnt_row);
    while($cnt_row > 0){
        $qa13 = mysqli_fetch_assoc($sql1);
        $booktmp = $qa13["books"];

        $book1 = mysqli_query($link, "SELECT book_name FROM book WHERE book_id LIKE '$booktmp'");
        $bookname = $book1->fetch_assoc();
        printf(" '%s',", $bookname['book_name']);

        $cnt_row--;
    }
}

mysqli_close($link);
} 

?>

<html>
<head>
</head>
<body>
    <form method="POST" action="">
        <p>Имя автора</p>
        <input name="author_name" type="text" placeholder="Имя"/> <br/> <br/>
        <input name="author_surname" type="text" placeholder="Фамилия"/>
        
        <p>Название книги</p>
        <input name="book_name" type="text" placeholder="Книга"/> <br/> <br/>

        <input type="submit" value="Отправить"/> <br/> <br/> <br/> 
        
        <p>Поиск книги</p>
        <input type="search" name="search_q">
        <input type="submit" value="Search"> <br/> <br/> <br/> 

        <p>Поиск книги с фильтром по автору </p>
        <p>
          <label>
          <select name="id_prof">
            <option value="1">Remark Erich</option>
            <option value="2">Alexander Pushkin</option>
            <option value="3">Mikhail Lermontov</option>
            <option value="4">Alexander Kuprin</option>
            <option value="5">Jack London</option>
            <option value="6">Agatha Christie</option>
            <option value="7">Arthur Conan Doyle</option>
          </select>
          </label>
        </p>
        <p>
          <input type="submit" name="filter" value="Вывести" />
        </p>
      
    </form>
</body>
</html>