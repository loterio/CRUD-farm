<?php 
    require_once('config/config.ini.php');
    $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PW);
    
        if(!$conexao)
            die("Erro na conexão com o banco de dados.");
    
        $nome = $_POST['nome'];
        $crmv = $_POST['crmv'];
        $tel = $_POST['tel'];
            
        $sql = 'SELECT * FROM VETERINARIO';
    
        $stmt = $conexao->prepare($sql);
        if(!$stmt)
            die("Erro ao criar comando. Erro: ".$conexao->errorInfo());

        $itens = '';
        while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
            $item = file_get_contents('itens.html');
            $item = str_replace('{id}',$linha['VETERINARIOCOD'],$item);
            $item = str_replace('{nome}',$linha['NOME'],$item);
            $item = str_replace('{crmv}',$linha['CRMV'],$item);
            $item = str_replace('{tel}',$linha['TELEFONE'],$item);
            $itens = $item;
        }
        $lista = file_get_contents('listagem.html');
        $lista = str_replace('{itens}',$itens,$lista);
        print($lista);

?>