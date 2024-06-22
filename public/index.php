<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/css/application.css">
</head>
<body>
    <div class="login-container">
        <h1>MatEs</h1>
        <h3> Sistema de Matrículas</h3>
        <form action="processa_login.php" method="post">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <label for="type">Tipo:</label>
            <select id="type" name="type">
                <option value="server">Servidor</option>
                <option value="student">Aluno</option>
            </select><br><br>
            
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
