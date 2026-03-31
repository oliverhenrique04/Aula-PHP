<?php
session_start(); // Inicia a sessão para poder manipulá-la
session_destroy(); // Destrói todos os dados da sessão (rasga o crachá)

// Redireciona de volta para a tela de login
header("Location: login.php");
exit;
?>