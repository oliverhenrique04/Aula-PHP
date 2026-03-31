<?php
session_start();

$mensagem_erro = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = pg_connect("host=localhost dbname=produtos user=postgres password=123456");
    
    if (!$conn) {
        die("Erro de conexão.");
    }

    $user_digitado = $_POST['username'];
    $senha_digitada = $_POST['password'];

    // Busca o usuário no banco (verificando se ele está com status = true)
    $query = "SELECT * FROM public.usuario WHERE username = $1 AND password = $2 AND status = true";
    $resultado = pg_query_params($conn, $query, array($user_digitado, $senha_digitada));

    // Se pg_num_rows retornar 1, significa que achou o usuário com a senha certa!
    if (pg_num_rows($resultado) > 0) {
        // Cria o "crachá" de acesso na sessão
        $_SESSION['usuario_logado'] = $user_digitado;
        
        // Redireciona o usuário para a página principal
        header("Location: index.php");
        exit; 
    } else {
        $mensagem_erro = "Usuário ou senha incorretos, ou usuário inativo.";
    }

    pg_close($conn);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login do Sistema</title>
</head>
<body>
    <h2>Acesso ao Sistema</h2>
    
    <div style="color: red;"><?php echo $mensagem_erro; ?></div>

    <form method="POST" action="login.php">
        <label>Usuário:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>