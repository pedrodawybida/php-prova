<?php
class UsuarioModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function adicionarUsuario($nome, $cnpj, $email, $telefone) {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, cnpj, email, telefone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $cnpj, $email, $telefone);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editarUsuario($id, $nome, $cnpj, $email, $telefone) {
        $stmt = $this->conn->prepare("UPDATE usuarios SET nome=?, cnpj=?, email=?, telefone=? WHERE id=?");
        $stmt->bind_param("ssssi", $nome, $cnpj, $email, $telefone, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function excluirUsuario($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function listarUsuarios($paginaAtual, $porPagina) {
        $offset = ($paginaAtual - 1) * $porPagina;
        $stmt = $this->conn->prepare("SELECT * FROM usuarios LIMIT ?, ?");
        $stmt->bind_param("ii", $offset, $porPagina);
        $stmt->execute();
        $result = $stmt->get_result();

        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }

        return $usuarios;
    }

    public function getTotalUsuarios() {
        $stmt = $this->conn->query("SELECT COUNT(id) AS total FROM usuarios");
        $row = $stmt->fetch_assoc();
        return $row['total'];
    }
}
?>
