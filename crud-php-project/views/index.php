<?php
include_once "../includes/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/style.css">

    <title>Biblioteca de livros </title>
</head>
<style>

</style>


<body>
    <header>
        <h2>Biblioteca de livros
        </h2>
    </header>


    <div class="favoritos-container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Favoritos</button>
    </div>


    <!-- Modal -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 90vw; /* Ajuste a largura máxima conforme necessário */">
            <div class="modal-content" style="height: 80vh; width: 100%; ">
                <div class="modal-header" style="background-color: #002D62;">
                    <h5 class="modal-title" id="staticBackdropLabel"style="color: #ffffff;">Livros Favoritos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="display: flex; flex-wrap: wrap; gap: 15px; overflow-y: auto; padding: 15px;"> <!-- Flexbox para disposição dos cards -->
                    <?php
                    include '../includes/conexao.php';

                    try {
                        $sql = "SELECT id, titulo, descricao, urlimg, favorito FROM livros WHERE favorito = 1 ORDER BY id DESC";

                        $stmt = $conn->query($sql);
                        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($resultados as $resultado) {
                            $favoritoClass = $resultado['favorito'] == 1 ? 'red-heart' : '';

                            $descricao = htmlspecialchars($resultado['descricao']);
                            $descricao_abreviada = strlen($descricao) > 100 ? substr($descricao, 0, 100) . "..." : $descricao;

                            echo "<div class='card'>";
                            echo "<div class='img-container'>";
                            echo "<img src='" . htmlspecialchars($resultado['urlimg']) . "' alt='Imagem' class='main-img'>";
                            echo "<img src='../img/heart.png' alt='Heart Icon' class='heart-icon $favoritoClass' id='heart-icon-" . htmlspecialchars($resultado['id']) . "' style='width: 20px; color: red;' onclick='changeHeartColor(" . htmlspecialchars($resultado['id']) . ")'>";
                            echo "</div>";
                            echo "<div class='linha'>";
                            echo "<hr style='border: none; height: 4px; background-color: black; margin-top: 2px;'>";
                            echo "</div>";
                            echo "<div class='card-title'>";
                            echo "<h1 class='titulo-card' data-id='" . htmlspecialchars($resultado['id']) . "' data-title='" . htmlspecialchars($resultado['titulo']) . "'>" . htmlspecialchars($resultado['titulo']) . "</h1>";

                            echo "<p class='descricao-text' title='" . htmlspecialchars($resultado['descricao']) . "'>" . $descricao_abreviada . "</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } catch (PDOException $e) {
                        echo "Erro: " . $e->getMessage();
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>



    <section class="section-with">
        <div class="cards-container">
            <?php
            include_once "../includes/conexao.php";

            try {
                $sql = "SELECT id, titulo, descricao, urlimg, favorito FROM livros ORDER BY favorito DESC, id DESC";

                $stmt = $conn->query($sql);
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultados as $resultado) {
                    $favoritoClass = $resultado['favorito'] == 1 ? 'red-heart' : '';

                    $descricao = htmlspecialchars($resultado['descricao']);
                    $descricao_abreviada = strlen($descricao) > 100 ? substr($descricao, 0, 100) . "..." : $descricao;

                    echo "<div class='card'>";
                    echo "<div class='img-container'>";
                    echo "<img src='" . htmlspecialchars($resultado['urlimg']) . "' alt='Imagem' class='main-img'>";
                    echo "<img src='../img/heart.png' alt='Heart Icon' class='heart-icon $favoritoClass' id='heart-icon-" . htmlspecialchars($resultado['id']) . "' style='width: 20px;' onclick='changeHeartColor(" . htmlspecialchars($resultado['id']) . ")'>";
                    echo "</div>";
                    echo "<div class='linha'>";
                    echo "<hr style='border: none; height: 4px; background-color: black; margin-top: 2px;'>";
                    echo "</div>";
                    echo "<div class='card-title'>";
                    echo "<h1 class='titulo-card' data-id='" . htmlspecialchars($resultado['id']) . "' data-title='" . htmlspecialchars($resultado['titulo']) . "'>" . htmlspecialchars($resultado['titulo']) . "</h1>";

                    echo "<p class='descricao-text' title='" . htmlspecialchars($resultado['descricao']) . "'>" . $descricao_abreviada . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }

            $conn = null;
            ?>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="height: auto;">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p style="display: none;">Card com ID: <span id="cardId"></span> foi clicado!</p>
                        <h2 style="font-family: Arial, Helvetica, sans-serif; text-align: center;">Deseja excluir o livro <span id="cardTitle"></span>?</h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="confirmDeleteBtn" class="btn btn-info">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="button-container">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                Adicionar
            </button>
        </div>
    </section>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #0a2351; text-align: center;">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white; margin: 0; 
                    width: 100%; font-family: 'Arial', sans-serif; font-weight: 100;">Adicionar livro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
                </div>

                <div class="modal-body">
                    <form action="../actions/process_form.php" method="POST">
                        <div class="row">
                            <div class="row">
                                <label for="">Titulo:</label>
                                <input type="text" class="form-control" name="titulo" required>
                            </div>
                            <div class="row">
                                <label for="">Descrição</label>
                                <textarea id="descricao" class="form-control" name="descricao" rows="4" required></textarea>
                                <!-- <input type="text" class="form-control" name="descricao" required> -->
                            </div>
                            <div class="row">
                                <label for="">URL imagem</label>
                                <input type="text" class="form-control" name="urlimg" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Confirma</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="../js/app.js"></script>


</body>

</html>