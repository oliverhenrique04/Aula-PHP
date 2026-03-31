<?php
session_start();

if (!isset($_SESSION['usuario_logado'])) {
    header("Location: login.php");
    exit;
}

// ==========================================
// 1. LÓGICA DO BANCO DE DADOS (Tudo no topo)
// ==========================================
$conn = pg_connect("host=localhost dbname=produtos user=postgres password=123456");
if (!$conn) { die("Erro crítico na conexão."); }

// Variáveis para guardar as mensagens do sistema
$mensagens = "";

// INSERT
//$query_insert = "INSERT INTO public.usuario (username, password, status) VALUES ($1, $2, $3)";
//$res_insert = pg_query_params($conn, $query_insert, array('novo_user', 'senha123', 'true'));
//if ($res_insert) {
//    $mensagens .= "<div style='color: green;'>Registro inserido com sucesso!</div>";
//}

// UPDATE
$query_update = "UPDATE public.usuario SET password = 'nova' WHERE username = 'carlos_silva'";
$res_update = pg_query($conn, $query_update);
if ($res_update) {
    $mensagens .= "<div style='color: blue;'>Registro atualizado com sucesso!</div>";
}

// SELECT (Vamos guardar os usuários em um array para imprimir depois)
$usuarios_lista = "";
$resultado_select = pg_query($conn, "SELECT * FROM public.usuario");
if ($resultado_select) {
    while ($linha = pg_fetch_assoc($resultado_select)) {
        $usuarios_lista .= "<li>" . htmlspecialchars($linha['username']) . "</li>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestão</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .painel { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; }
    </style>
</head>
<body>

    <?php if(!empty($mensagens)) echo "<div class='painel'>$mensagens</div>"; ?>

    <h2>Lista de Usuários</h2>
    <div class="painel">
        <ul>
            <?php echo $usuarios_lista; ?>
        </ul>
    </div>

    <h2>Tabela de Produtos</h2>
    <?php include('cabecalho.php'); ?>
    
    </body>
</html>

<?php 
// Fecha a conexão bem no final de tudo
pg_close($conn); 
?>