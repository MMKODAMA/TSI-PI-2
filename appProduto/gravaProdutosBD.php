<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("../connection/connectionFactory.php");

$_POST['nome'] = $_POST['nome'] ?? '';
$_POST['preco'] = $_POST['preco'] ?? '';
$_POST['desc'] = $_POST['desc'] ?? '';
$_POST['quant'] = $_POST['quant'] ?? '';


//chechar os campos obrigátorios
if(empty($_POST['nome'] || $_POST['preco'] || $_POST['quant'])){
    die('ERRO! os campos são obriatórios');
}

//Preparamos a consulta para evitar SQL Injection
$stmt = $db->prepare(" INSERT INTO produto
                            (nome, preco, descricao, quantidade)
                        VALUES 
                            (:nome, :preco, :descricao, :quantidade)");

$valores[':nome'] = $_POST['nome'];
$valores[':preco'] = $_POST['preco'];
$valores[':descricao'] = $_POST['descricao'];
$valores[':quantidade'] = $_POST['quant'];

//Executamos a consulta SQL
if( $stmt->execute($valores) ){
    header('Location: listarProdutos.php?gravado=1');
} else {
    echo "<br><br> Não consegui gravar no banco :-(";
}










/*
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$bd_dsn = 'mysql:host=localhost;port=3306;dbname=ling_serv';
$bd_user = 'root';
$bd_pass = '';

$bd = new PDO($bd_dsn,$bd_user,$bd_pass);

//Preparamos a consulta para evitar SQL Injection
$stmt = $bd->prepare(' INSERT imagem 
                            (nomearq, diretorio) 
                        VALUES 
                            (:nomearq, :diretorio)');

$valores[':nomearq'] = $_FILES['arquivoDoUsuario']['name'];
$valores[':diretorio'] = $_FILES['arquivoDoUsuario']['tmp_name'];

//Executamos a consulta SQL
if( $stmt->execute($valores) ){
    echo"foi";
} else {
    echo "<br><br> Não consegui gravar no banco ";
}
*/