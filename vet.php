<?php 
    // Controle da Interface
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        
        $form = file_get_contents('cadastroVet.html');
        $form = str_replace('{nome}','Me',$form);
        $form = str_replace('{crmv}','',$form);
        $form = str_replace('{tel}','',$form);
        print($form);
    }else if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['nome'])){
            require_once('config/config.ini.php');
            $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PW);
    
            if(!$conexao)
                die("Erro na conexão com o banco de dados.");
    
            $nome = $_POST['nome'];
            $crmv = $_POST['crmv'];
            $tel = $_POST['tel'];
            
            $sql = 'INSERT INTO VETERINARIO(NOME,CRMV,TELEFONE)
                    VALUES(:nome, :crmv, :tel)';
    
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome',$nome);
            $stmt->bindParam(':crmv',$crmv);
            $stmt->bindParam(':tel',$tel);
            $stmt->execute();
    
            if(!$stmt)
                die("Erro ao criar comando. Erro: ".$conexao->errorInfo());
            echo "Sucessfuly sign up.";
    
        }
    }

?>