<?php
namespace App\Model;
use PDO;
class Conexao {

    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $dbpass = '';
    private $dbname = 'geradorXml';

    public function PDOConnect()
    {
        $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
    private function abrir() 
    {
        $link = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if ($link)
            return $link;
        else
            return FALSE;
    }

    private function fechar($link) 
    {
        mysqli_close($link);
    }

    public function consultar($query) 
    {
        $link = $this->abrir();
        if ($link) {
            $result = mysqli_query($link, $query);
            $this->fechar($link);
            return $result;
        } else {
            return FALSE;
        }
    }

    public function executar($query) {
        $link = $this->abrir();
        if ($link) {
            mysqli_query($link, $query);
            $this->fechar($link);
        }
    }

}
