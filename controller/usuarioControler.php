<?php
include 'db_connect.php';
include 'UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel($GLOBALS['conn']);
    }

    public function listarUsuarios($paginaAtual, $porPagina) {
        return $this->model->listarUsuarios($paginaAtual, $porPagina);
    }

    public function getTotalUsuarios() {
        return $this->model->getTotalUsuarios();
    }

    // Funções para adicionar, editar e excluir usuários
    // Você pode implementar essas funções conforme os métodos no modelo
    // Exemplo:
    public function adicionarUsuario($nome, $cnpj, $email, $telefone) {
        return $this->model->adicionarUsuario($nome, $cnpj, $email, $telefone);
    }

    public function editarUsuario($id, $nome, $cnpj, $email, $telefone) {
        return $this->model->editarUsuario($id, $nome, $cnpj, $email, $telefone);
    }

    public function excluirUsuario($id) {
        return $this->model->excluirUsuario($id);
    }
}
?>
