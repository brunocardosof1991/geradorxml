<?php
namespace App\Model;
use App\Model\Conexao;
use PDO;
class Usuario 
{
    
    function __construct()
    {
        $this->connection = new Conexao();
    }   
    public function add($request)
    {     
        $usuario = $request->getParam('usuario');
        $email = $request->getParam('email');
        $senha = $request->getParam('senha');
        $status = $request->getParam('status');
        $sql = "INSERT INTO usuario (usuario,email,senha,status) VALUES
        (:usuario,:email,:senha,:status)";
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':usuario',  $usuario);
            $stmt->bindParam(':email',      $email);
            $stmt->bindParam(':senha',    $senha);
            $stmt->bindParam(':status',       $status);
            $stmt->execute();
            echo json_encode('{"success": "Usuario Adicionado"}');
        } catch(PDOException $e){
            echo json_encode('{"error": '.$e->getMessage().'}');
        }
    } 
    public function validateSenha($senha)
    {
        $sql = "SELECT * FROM usuario WHERE senha = '$senha'";
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($usuario);           
            $connection = null;
        }catch(PDOException $e){
            echo json_encode('{"error": '.$e->getMessage().'}');
        }
    }
    public function validateLogin($login)
    {
        $sql = "SELECT * FROM usuario WHERE (email = '$login')";
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($usuario);      
            $connection = null;
        }catch(PDOException $e){
            echo json_encode('{"error": '.$e->getMessage().'}');
        }
    }
    public function logar($login, $senha){  
        $sql = "SELECT * FROM usuario WHERE senha = '$senha' AND 
        ( usuario = '$login' OR email = '".$login."'  )";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return($usuario);    
            $connection = null;
        }catch(PDOException $e){
            echo json_encode('{"error": '.$e->getMessage().'}');
        }
    }
    public function logout()
    {
        session_start();    
        if( isset( $_SESSION['logado']) )
            unset($_SESSION['logado']);
        
        if( isset( $_SESSION['id']) )
            unset($_SESSION['id']);    
        
        if( isset( $_SESSION['usuario']) )
            unset($_SESSION['usuario']);               
        session_destroy(); 
        /* header("location:http://localhost/geradorXml/App/View/Login/Login.php"); */
        /* exit; */
    }

}
