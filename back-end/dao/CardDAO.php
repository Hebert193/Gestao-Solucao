<?php
// CREATE TABLE cards (
//     id INT AUTO_INCREMENT PRIMARY KEY,            -- ID único do card
//     titulo VARCHAR(255) NOT NULL,                -- Título do card (obrigatório)
//     id_modulo INT NOT NULL,                       -- ID do módulo associado
//     FOREIGN KEY (id_modulo) REFERENCES modulo(id) ON DELETE CASCADE -- Remove cards se o módulo for deletado
// );

class CardDAO {
    private $conn; // Conexão com o banco de dados

    // Construtor da classe, obtém a conexão com o banco
    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Método para cadastrar um novo card
    public function cadastrarCard(Card $card) {
        // SQL para inserir o card
        $sql = "INSERT INTO cards (titulo, id_modulo) VALUES (:titulo, :id_modulo)";
        $stmt = $this->conn->prepare($sql);

        // Obtém os valores do objeto Card
        $titulo = $card->getTitulo();
        $id_modulo = $card->getIdModulo();

        // Associa os parâmetros da query aos valores
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':id_modulo', $id_modulo, PDO::PARAM_INT);

        // Executa a query e retorna true ou false
        return $stmt->execute();
    }

    // Método para listar todos os cards de um módulo específico
    public function listarCardsPorModulo($id_modulo) {
        // SQL para buscar cards pelo ID do módulo
        $sql = "SELECT * FROM cards WHERE id_modulo = :id_modulo";
        $stmt = $this->conn->prepare($sql);

        // Associa o parâmetro
        $stmt->bindParam(':id_modulo', $id_modulo, PDO::PARAM_INT);

        // Executa a query
        $stmt->execute();

        // Busca todos os resultados
        $cardsData = $stmt->fetchAll();

        // Cria objetos Card a partir dos dados retornados
        $cards = [];
        foreach ($cardsData as $cardData) {
            $cards[] = new Card($cardData['id'], $cardData['titulo'], $cardData['id_modulo']);
        }

        // Retorna um array de objetos Card
        return $cards;
    }
}
?>
