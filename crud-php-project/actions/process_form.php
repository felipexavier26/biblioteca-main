<?php
include_once "../includes/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $urlimg = $_POST['urlimg'];

    if (empty($titulo) || empty($descricao) || empty($urlimg)) {
        die("Todos os campos do formulário são obrigatórios.");
    }

    try {
        $sql = "INSERT INTO livros (titulo, descricao, urlimg) VALUES (:titulo, :descricao, :urlimg)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':urlimg', $urlimg, PDO::PARAM_STR);

        // Executa a consulta
        if ($stmt->execute()) {
            echo "<script>
            alert('Novo registro criado com sucesso');
            setTimeout(function() {
                window.location.href = 'http://localhost/biblioteca-main/crud-php-project/views/';
            }, 100); // 2 segundos de espera antes do redirecionamento
          </script>";
            exit;
        } else {
            echo "Erro ao executar a consulta";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

$conn = null;
