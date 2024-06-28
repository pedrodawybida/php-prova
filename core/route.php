<?php
// routes.php

// Carrega o arquivo de conexão com o banco de dados
require_once 'app/includes/db_connect.php';

// Carrega as classes necessárias
require_once 'app/controllers/UsuarioController.php';

// Obtém o caminho da URL
$route = isset($_GET['route']) ? $_GET['route'] : '';

// Instancia o controlador de usuários
$usuarioController = new UsuarioController();

// Roteamento com base no caminho da URL
switch ($route) {
    case '':
    case 'listar':
        $usuarioController->listarUsuarios();
        break;

    case 'adicionar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioController->adicionarUsuario($_POST);
        } else {
            $usuarioController->exibirFormularioAdicao();
        }
        break;

    case 'editar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioController->editarUsuario($_POST);
        } else {
            $usuarioController->exibirFormularioEdicao($_GET['id']);

            function exibirFormularioEdicao($id)
            {
                // Code to display the edit form for the user with the given ID
            }
        }
        break;

    case 'excluir':
        $usuarioController->excluirUsuario($_GET['id']);
        break;

    default:
        // Rota não encontrada
        http_response_code(404);
        echo "Página não encontrada";
        break;
}
?>
