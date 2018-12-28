<?php
namespace App\Model;
use App\Model\Conexao;
use ArrayObject;
require_once $_SERVER['DOCUMENT_ROOT'].'../../vendor/autoload.php';

class Cliente {
    
    public $id;
    public $nome;
    public $CNPJ;
    public $endereco;
    public $numero;
    public $complemento;
    public $bairro;
    public $CEP;
    public $celular;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCNPJ() {
        return $this->CNPJ;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCEP() {
        return $this->CEP;
    }

    function getCelular() {
        return $this->celular;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCNPJ($CNPJ) {
        $this->CNPJ = $CNPJ;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCEP($CEP) {
        $this->CEP = $CEP;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    public function inserir() {
        $conexao = new Conexao();
        $query = "INSERT INTO `cliente`(`id`, `nome`, `CNPJ`, `endereco`, `numero`, `complemento`,
         `bairro`, `CEP`, `celular`) VALUES(
                '" . $this->id . "' ,               
                '" . $this->nome . "' ,               
                '" . $this->CNPJ . "' ,               
                '" . $this->endereco . "' ,               
                '" . $this->numero . "' ,               
                '" . $this->complemento . "' ,               
                '" . $this->bairro . "' ,               
                '" . $this->CEP . "' ,               
                '" . $this->celular . "')";
        $query = $conexao->executar($query);
    }
    
    public function editar() {
        $connection = new Connection();
        $sql = "UPDATE cliente SET 
                nome =   " .$this->nome. ",
                CNPJ =   " .$this->CNPJ. ",
                endereco =   " .$this->endereco. ", 
                numero =   " .$this->numero. ", 
                complemento = ". $this->complemento. ",
                bairro =   " .$this->bairro. ",
                cep =   " .$this->CEP. ",
                celular =     " .$this->celular  . " WHERE id = ".$this->id;

        $connection->executar($sql);
    }
    public static function listar()
    {
        $conexao = new Conexao();
        $sql = "SELECT * FROM cliente";
        $result = $conexao->consultar($sql);
        $lista = new ArrayObject();
        while(list($id, $nome, $CNPJ, $endereco, $numero, $complemento,$bairro,$CEP,$celular) = mysqli_fetch_row($result)) 
        {
            $clienteObj = new Cliente();
            $clienteObj->id = $id;
            $clienteObj->nome = $nome;
            $clienteObj->CNPJ = $CNPJ;
            $clienteObj->endereco = $endereco;
            $clienteObj->numero = $numero;
            $clienteObj->complemento = $complemento;
            $clienteObj->bairro = $bairro;
            $clienteObj->CEP = $CEP;
            $clienteObj->celular = $celular;
            $lista->append($clienteObj);
        }
        return $lista;
    }
    
    public function excluir() {
        $connection = new Connection();
        $sql = "DELETE FROM cliente 
        WHERE id = ".$this->id;
        $connection->executar($sql);
    }
    
}

?>

