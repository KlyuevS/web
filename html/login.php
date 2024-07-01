<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY NAME - Авторизация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        body {
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn_red {
            background-color: #dc3545;
            color: white;
        }
        .btn_red:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="text-center mb-4">Авторизация</h1>
        <form method="POST" action="login.php">               
            <div class="mb-3">
                <input class="form-control" type="text" name="login" placeholder="Логин" required>
            </div>
            <div class="mb-3">
                <input class="form-control" type="password" name="password" placeholder="Пароль" required>
            </div>
            <button type="submit" class="btn btn_red btn-block w-100" name="submit">Продолжить</button>
        </form>
    </div>
</body>
</html>

<?php 
require_once('db.php');

$link = mysqli_connect('172.20.0.3', 'root', 'kali', 'mydata');

if (isset($_COOKIE['User'])) {
    header("Location: profile.php");
}

if (isset($_POST['submit'])) {    
    $username = $_POST['login'];
    $pass = $_POST['password'];

    if (!$username || !$pass) die("Пожалуйста, введите все значения");

    // Уязвимый SQL запрос
    $sql = "SELECT * FROM users WHERE username='$username' AND pass='$pass' OR 1=1";
    $result = mysqli_query($link, $sql);

    if (!$result) {
        echo "Не удалось получить данные пользователя";
    } else {
        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Список пользователей:</h2>";
            echo "<table class='table table-striped'>";
            echo "<thead><tr><th>ID</th><th>Username</th><th>Password</th></tr></thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . htmlspecialchars($row['id']) . "</td><td>" . htmlspecialchars($row['username']) . "</td><td>" . htmlspecialchars($row['pass']) . "</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "Неверный логин или пароль";
        }
    }
}
?>
