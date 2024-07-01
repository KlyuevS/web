<?php
session_start();
require_once('db.php');

// Подключение к базе данных
$link = mysqli_connect('172.20.0.3', 'root', 'kali', 'mydata');

if (!$link) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

// Проверка авторизации пользователя
if (!isset($_COOKIE['User'])) {
    header('Location: login.php'); // Перенаправление на страницу входа, если пользователь не авторизован
    exit();
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY NAME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="hello">
				Привет, <?php echo htmlspecialchars($_COOKIE['User']); ?>
			</h1>
		</div>
	</div>
</body>
</html>
