<!--
-- Tabela cards
CREATE TABLE cards (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- ID único do card
    titulo VARCHAR(255) NOT NULL,              -- Título do card, obrigatório
    id_modulo INT NOT NULL,                     -- ID do módulo ao qual o card pertence
    FOREIGN KEY (id_modulo) REFERENCES modulo(id) ON DELETE CASCADE -- Deleta cards se o módulo for deletado
)ENGINE=InnoDB;
-->

<?php
// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Captura os dados enviados pelo formulário
    $titulo = $_POST['titulo'];
    $id_modulo = $_POST['id_modulo'];

    // Importa arquivos necessários para conexão e manipulação do banco
    require_once __DIR__ . '/../database/database.php'; // Conexão com o banco
    require_once __DIR__ . '/../model/Card.php';         // Classe Card
    require_once __DIR__ . '/../dao/CardDAO.php';        // DAO para operações com cards

    // Cria um objeto Card com os dados do formulário
    $card = new Card(null, $titulo, $id_modulo);

    // Instancia o DAO para manipulação de cards
    $cardDAO = new CardDAO();

    // Tenta cadastrar o card no banco
    if ($cardDAO->cadastrarCard($card)) {
        // Se sucesso, redireciona para a home passando o módulo na URL
        header('Location: ../home.php?id_tabela=' . $id_modulo);
        exit();
    } else {
        // Se ocorrer erro, exibe mensagem
        echo "Erro ao cadastrar card.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Card</title>
    <link rel="stylesheet" href="../../css/login.css"> <!-- Estilo da página -->
</head>
<body>

    <!-- Formulário para adicionar um novo card -->
    <form action="Addcard.php" method="POST">
        <h1>Adicionar Card</h1>

        <!-- Campo de título do card -->
        <label for="titulo"></label>
        <input type="text" name="titulo" placeholder="Titulo" required>

        <!-- Campo oculto para associar o card a um módulo -->
        <input type="hidden" name="id_modulo" value="<?php echo $_GET['id_tabela']; ?>">

        <!-- Botão de envio -->
        <button type="submit">Adicionar</button>
    </form>

</body>
</html>
