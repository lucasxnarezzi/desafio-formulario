<?php
$response = array();

if(isset($_POST['nome'], $_POST['idade'], $_POST['rua'], $_POST['bairro'], $_POST['estado'], $_POST['bio'])) {
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = '';
    $dbName = 'sync360';

    $conexao = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if($conexao->connect_errno) {
        $response['success'] = false;
        $response['message'] = 'Erro na conexão com o banco de dados: ' . $conexao->connect_error;
    } else {
        $nome = $_POST['nome'];
        $idade = $_POST['idade'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $estado = $_POST['estado'];
        $bio = $_POST['bio'];

        $sql = "INSERT INTO usuarios (nome, idade, rua, bairro, estado, biografia)
        VALUES ('$nome', $idade, '$rua', '$bairro', '$estado', '$bio')";
        
        if($conexao->query($sql) === TRUE) {
            $response['success'] = true;
            $response['data'] = array(
                'nome' => $nome,
                'idade' => $idade,
                'rua' => $rua,
                'bairro' => $bairro,
                'estado' => $estado,
                'bio' => $bio
            );
        } else {
            $response['success'] = false;
            $response['message'] = 'Erro ao inserir dados: ' . $conexao->error;
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Campos obrigatórios não fornecidos.';
}

// Enviar resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
