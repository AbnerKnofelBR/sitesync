<?php
// Configurações do banco de dados
$host = 'localhost'; // ou o endereço do seu servidor
$dbname = 'u746534611_form';
$username = 'u746534611_form';
$password = '#Sync2019';

try {
    // Conectar ao banco de dados
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitização dos dados
        $nome = htmlspecialchars(strip_tags(trim($_POST['nome'])));
        $telefone = htmlspecialchars(strip_tags(trim($_POST['telefone'])));

        // Preparar a declaração SQL
        $stmt = $conn->prepare("INSERT INTO contatos (nome, telefone) VALUES (:nome, :telefone)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);

        // Executar a declaração
        if ($stmt->execute()) {
            // Redirecionar para outra página após o sucesso
            header("Location: sucesso.php");
            exit; // Para garantir que o script pare de ser executado
        } else {
            echo "Erro ao salvar os dados.";
        }
    }
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

// Fechar a conexão
$conn = null;
?>