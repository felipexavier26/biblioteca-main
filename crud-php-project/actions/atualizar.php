<?php
include_once "../includes/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $favorito = $_POST['favorito'];

    $sql = "UPDATE livros SET favorito = :favorito WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':favorito', $favorito, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Atualização bem-sucedida";
    } else {
        echo "Erro ao atualizar o banco de dados";
    }
}
?>
