<!DOCTYPE html>
<?php 
    $title = 'Cadastro de Veterinário';

    if (isset($_GET['nome'])){
        require_once('config/config.ini.php');
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PW);

        if(!$conexao)
            die("Erro na conexão com o banco de dados.");

        $nome = $_GET['nome'];
        $crmv = $_GET['crmv'];
        $tel = $_GET['tel'];
        
        $sql = 'INSERT INTO VETERINARIO(NOME,CRMV,TELEFONE)
                VALUES(:nome, :crmv, :tel)';

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome',$nome);
        $stmt->bindParam(':crmv',$crmv);
        $stmt->bindParam(':tel',$tel);
        $stmt->execute();

    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
    
    * {
        font-family: Helvetica;
    }

    </style>
</head>
<body>
    <h1><?php echo $title; ?></h1>
    <form method="get">
        <label for="nome">nome</label>
        <input name="nome" type="text" value='<?php echo $_GET['nome'] ?>'>
        
        <label for="crmv">CRMV</label>
        <input name="crmv" type="text" value='<?php echo $_GET['crmv'] ?>'>
        
        <label for="tel">tel</label>
        <input name="tel" type="text" value='<?php echo $_GET['tel'] ?>'>

        <input type="submit" value="send">
    </form>
</body>
</html>