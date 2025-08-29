<!--
-- Tabela cards
CREATE TABLE cards (
    id INT AUTO_INCREMENT PRIMARY KEY,    -- ID único do card
    titulo VARCHAR(255) NOT NULL,     -- Título do card (obrigatório)
    id_modulo INT NOT NULL,    -- ID do módulo ao qual o card pertence
    FOREIGN KEY (id_modulo) REFERENCES modulo(id) ON DELETE CASCADE -- Remove cards se o módulo for deletado
);
-->

<?php
// Classe que representa um Card
class Card {
    // Propriedades privadas do card
    private ?int $id;         // ID do card (pode ser null antes de salvar no banco)
    private string $titulo;   // Título do card
    private int $id_modulo;   // ID do módulo associado

    // Construtor da classe
    public function __construct($id, $titulo, $id_modulo) {
        $this->id = $id;          // Inicializa o ID
        $this->titulo = $titulo;  // Inicializa o título
        $this->id_modulo = $id_modulo; // Inicializa o ID do módulo
    }

    // Getter para ID
    public function getId() {
        return $this->id;
    }

    // Getter para Título
    public function getTitulo() {
        return $this->titulo;
    }

    // Getter para ID do módulo
    public function getIdModulo() {
        return $this->id_modulo;
    }
}
?>
