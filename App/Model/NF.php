<?php
namespace App\Model;
use App\Model\Conexao;
use ArrayObject;

class NF
{
    public $id;
    public $chave;
    public $cNF;
    public $nNF;
    public $dhEmi;
    public $CNPJDestinatario;
    public $xNomeDestinatario;
    private $connection = '';

    function __construct()
    {
        $this->connection = new Conexao();    
    }

    public function get_NF($id = 0) 
	{
        //Função estática não aceita $this;
        $query="SELECT * FROM NF";
        if($id !== 0) 
        {
            $query = '';
            $query ="SELECT * FROM NF WHERE id=".$id." LIMIT 1";
        }
		$result = $this->connection->consultar($query);
        $lista = new ArrayObject();
        while (list($id, $chave, $cNF, $nNF, $dhEmi, $CNPJDestinatario, $xNomeDestinatario) 
        = mysqli_fetch_row($result)) 
        {     
            $NF = new NF();
            $NF->id = $id;
            $NF->chave = $chave;
            $NF->cNF = $cNF;
            $NF->nNF = $nNF;
            $NF->dhEmi = $dhEmi;
            $NF->CNPJDestinatario = $CNPJDestinatario;
            $NF->xNomeDestinatario = $xNomeDestinatario;
            $lista->append($NF);
        }		
        header('Content-Type: application/json');
        echo json_encode($lista);
    }
    public function insert_NF()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$NF_id  =$data["id"];
		$NF_chave=$data["chave"];
		$NF_cNF=$data["cNF"];
		$NF_nNF=$data["nNF"];
		$NF_dhEmi=$data["dhEmi"];
		$NF_CNPJDestinatario=$data["CNPJDestinatario"];
		$NF_xNomeDestinatario=$data["xNomeDestinatario"];
		echo $query="INSERT INTO NF SET id='{$NF_id}',chave='{$NF_chave}', cNF='{$NF_cNF}', nNF='{$NF_nNF}', dhEmi='{$NF_dhEmi}',
        CNPJDestinatario='{$NF_CNPJDestinatario}', xNomeDestinatario='{$NF_xNomeDestinatario}' ";        
        $result = $this->connection->consultar($query);
        $response = array();
        if ($result === true) {
			$response=array(
				'status' => 1,
				'status_message' =>'NF Added Successfully.'
			);
        } else {
			$response=array(
				'status' => 0,
				'status_message' =>'NF Addition Failed.'
			);
        }
		header('Content-Type: application/json');
		echo json_encode($response);
    }	
    public function update_NF($id)
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$NF_chave=$data["chave"];
		$NF_cNF=$data["cNF"];
		$NF_nNF=$data["nNF"];
		$NF_dhEmi=$data["dhEmi"];
		$NF_CNPJDestinatario=$data["CNPJDestinatario"];
		$NF_xNomeDestinatario=$data["xNomeDestinatario"];
		$query="UPDATE NF SET chave='{$NF_chave}', cNF='{$NF_cNF}', nNF='{$NF_nNF}', dhEmi='{$NF_dhEmi}',
        CNPJDestinatario='{$NF_CNPJDestinatario}', xNomeDestinatario='{$NF_xNomeDestinatario}' WHERE id ='{$id}' ";        
        $result = $this->connection->consultar($query);
        $response = array();
        if ($result === true) {
			$response=array(
				'status' => 1,
				'status_message' =>'NF Updated Successfully.'
			);
        } else {
			$response=array(
				'status' => 0,
				'status_message' =>'NF Updated Failed.'
			);
        }
		header('Content-Type: application/json');
		echo json_encode($response);
    }
    public function delete_NF($id)
    {
        $query="DELETE FROM NF WHERE id={$id}";
        $result = $this->connection->consultar($query);
        $response = array();
        if ($result === true) {
			$response=array(
				'status' => 1,
				'status_message' =>'NF Deleted Successfully.'
			);
        } else {
			$response=array(
				'status' => 0,
				'status_message' =>'NF Deleted Failed.'
			);
        }
		header('Content-Type: application/json');
		echo json_encode($response);
    }
}