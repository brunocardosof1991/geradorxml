<?php
namespace App\Model;
use App\Model\Conexao;
use App\Model\ICMS;
use App\Model\PIS;
use App\Model\COFINS;
use DateTime;
use DateTimeZone;
use DOMDocument;
use DOMAttr;
use ArrayIterator;
use PDO;
class Xml 
{
    //<ide>
    public $ide = array
    (
        'cUF' => NULL,
        'cNF' => NULL,
        'natOp' => NULL,
        'mod' => NULL,
        'serie' => NULL,
        'nNF' => NULL,
        'dhEmi' => NULL,
        'tpNF' => NULL,
        'idDest' => NULL,
        'cMunFG' => NULL,
        'tpImp' => NULL,
        'tpEmis' => NULL,
        'cDV' => NULL,
        'tpAmb' => NULL,
        'finNFe' => NULL,
        'indFinal' => NULL,
        'indPres' => NULL,
        'procEmi' => NULL,
        'verProc' => '1.0.0'
    );
    //<emit>
    public $emit = array
    (
        'CNPJ' => NULL,
        'xNome' => NULL,
        'xFant' => NULL,
        'IE' => NULL,
        'IM' => NULL,
        'CNAE' => NULL,
        'CRT' => NULL
    );
    //<enderEmit>
    public $enderEmit = array
    (
        'xLgr' => NULL,
        'nro' => NULL,
        'xBairro' => NULL,
        'cMun' => NULL,
        'xMun' => NULL,
        'UF' => NULL,
        'CEP' => NULL,
        'cPais' => NULL,
        'xPais' => NULL,
        'fone' => NULL
    );
    //<dest>
    public $dest = array
    (
        'CNPJ' => NULL,
        'xNome' => NULL,
        //9=Não Contribuinte, que pode ou não possuir Inscrição Estadual no Cadastro de Contribuintes do ICMS.
        'indIEDest' => 9
    );
        //<enderDest>
    public $enderDest = array
    (
        'xLgr' => NULL,
        'nro' => NULL,
        'xCpl' => 'Complemento',
        'xBairro' => NULL,
        'cMun' => 4314902,
        'xMun' => NULL,
        'UF' => NULL,
        'CEP' => NULL,
        'cPais' => 1058,
        'xPais' => 'Brasil',
        'fone' => NULL
    );
    public $detPag = array
    (
        'tPag' => NULL,
        'vPag' => NULL
    );
    public $card = array
    (
        'tpIntegra' => NULL,
        'CNPJ' => NULL,
        'tBand' => NULL,
        'cAut' => NULL
    );
    private $tpEvento = 110111;
    private $nSeqEvento = 1;
    private $connection = '';
    public $ICMSSN102 = array();
    public $PIS = array ();
    public $COFINS = array();
    function __construct() {
        $this->connection = new Conexao();
        $this->ICMS = ICMS::$ICMSSN102;
        $this->PIS = PIS::$PISAliq;
        $this->COFINS = COFINS::$COFINSAliq;
        //Startar Emissor com o cadastrado no Banco de Dados
        $this->emit['CNPJ'] = $this->gerarEmit()[0]['CNPJ'];
        $this->emit['xNome'] = $this->gerarEmit()[0]['xNome'];
        $this->emit['xFant'] = $this->gerarEmit()[0]['xFant'];
        $this->emit['IE'] = $this->gerarEmit()[0]['IE'];
        $this->emit['IM'] = $this->gerarEmit()[0]['IM'];
        $this->emit['CNAE'] = $this->gerarEmit()[0]['CNAE'];
        $this->emit['CRT'] = $this->gerarEmit()[0]['CRT'];
        $this->enderEmit['xLgr'] = $this->gerarEmit()[0]['xLgr'];
        $this->enderEmit['nro'] = $this->gerarEmit()[0]['nro'];
        $this->enderEmit['xBairro'] = $this->gerarEmit()[0]['xBairro'];
        $this->enderEmit['cMun'] = $this->gerarEmit()[0]['cMun'];
        $this->enderEmit['xMun'] = $this->gerarEmit()[0]['xMun'];
        $this->enderEmit['UF'] = $this->gerarEmit()[0]['UF'];
        $this->enderEmit['CEP'] = $this->gerarEmit()[0]['CEP'];
        $this->enderEmit['cPais'] = $this->gerarEmit()[0]['cPais'];
        $this->enderEmit['xPais'] = $this->gerarEmit()[0]['xPais'];
        $this->enderEmit['fone'] = $this->gerarEmit()[0]['fone'];
        //Startar Identificação da NFC-e com o cadastrado no Banco de Dados
        $this->ide['cUF'] = $this->gerarIde()[0]['cUF'];
        $this->ide['natOp'] = $this->gerarIde()[0]['natOp'];
        $this->ide['mod'] = $this->gerarIde()[0]['modelo'];
        $this->ide['serie'] = $this->gerarIde()[0]['serie'];
        $this->ide['tpNF'] = $this->gerarIde()[0]['tpNF'];
        $this->ide['idDest'] = $this->gerarIde()[0]['idDest'];
        $this->ide['cMunFG'] = $this->gerarIde()[0]['cMunFG'];
        $this->ide['tpImp'] = $this->gerarIde()[0]['tpImp'];
        $this->ide['tpEmis'] = $this->gerarIde()[0]['tpEmis'];
        $this->ide['tpAmb'] = $this->gerarIde()[0]['tpAmb'];
        $this->ide['finNFe'] = $this->gerarIde()[0]['finNFe'];
        $this->ide['indFinal'] = $this->gerarIde()[0]['indFinal'];
        $this->ide['indPres'] = $this->gerarIde()[0]['indPres'];
        $this->ide['procEmi'] = $this->gerarIde()[0]['procEmi'];
    }
    //<ide><idLote></idLote></ide>
    private function getId($table) 
    {
        $sql = "SELECT id FROM $table ORDER BY id DESC LIMIT 1";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $idLote = $stmt->fetchAll(PDO::FETCH_ASSOC);           
            return $idLote[0]["id"]+1;
            $connection = null;
        }catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    //<ide><dhEmi></dhEmi></ide>
    //Hora do servidor
    private function getTime() 
    {
        $data = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        date_default_timezone_set('America/Sao_Paulo');
        $fullData = $data = date('Y-m-d H:i:s');
        $dataString = str_replace(' ', 'T', $fullData);
        return $dataString .= '-02:00';
    }
    //<ide><nNF></nNF></ide>
    private function gerarNnf() 
    {        
        $sql = "SELECT nNF FROM nf ORDER BY nNF DESC LIMIT 1";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $nNF = $stmt->fetchAll(PDO::FETCH_ASSOC);           
            return $nNF[0]["nNF"]+1;
            $connection = null;
        }catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    //<ide><cNF></cNF></ide>
    private function gerarCnf()     
    {        
        $sql = "SELECT cNF FROM nf ORDER BY cNF DESC LIMIT 1";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $cNF = $stmt->fetchAll(PDO::FETCH_ASSOC);           
            return $cNF[0]["cNF"]+1;
            $connection = null;
        }catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    private function gerarEmit()
    {
        $sql = "SELECT * FROM emissor";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $emit = $stmt->fetchAll(PDO::FETCH_ASSOC);           
            return $emit;
            $connection = null;
        }catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function gerarIde()
    {
        $sql = "SELECT * FROM ide";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $emit = $stmt->fetchAll(PDO::FETCH_ASSOC);           
            return $emit;
            $connection = null;
        }catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function gerarChaveDeAcesso() 
    {
        //AAMM - Ano e mês da emissão da NFC-e
        $now = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $year = $now->format('y');
        $month = $now->format('m');
        $AAMM = $year . $month;
        $chaveString = $this->ide['cUF'] . $AAMM . $this->emit['CNPJ'] . $this->ide['mod'] .
                $this->ide['serie'] . $this->gerarNnf() . $this->ide['tpEmis'] . $this->gerarCnf();
        /*
         * Multiplicar os números da string $chaveString da direita para esquerda por 2,3,4,5,6,7,8,9,2,3,...
         * Somar a ponderação e dividir por 11
         * Para facilitar o entendimento do cálculo, dar enter após cada sinal de +
         */
        $ponderacaoString = 
        /* 1º Nº */substr($chaveString, -1, 1) * 2 + /* 2º Nº */substr($chaveString, -2, -1) * 3 + /* 3º Nº */substr($chaveString, -3, -2) * 4 + /* 4º Nº */substr($chaveString, -4, -3) * 5 + /* 5º Nº */substr($chaveString, -5, -4) * 6 + /* 6º Nº */substr($chaveString, -6, -5) * 7 + /* 7º Nº */substr($chaveString, -7, -6) * 8 + /* 8º Nº */substr($chaveString, -8, -7) * 9 + /* 9º Nº */substr($chaveString, -9, -8) * 2 + /* 10º Nº */substr($chaveString, -10, -9) * 3 + /* 11º Nº */substr($chaveString, -11, -10) * 4 + /* 12º Nº */substr($chaveString, -12, -11) * 5 + /* 13º Nº */substr($chaveString, -13, -12) * 6 + /* 14º Nº */substr($chaveString, -14, -13) * 7 + /* 15º Nº */substr($chaveString, -15, -14) * 8 + /* 16º Nº */substr($chaveString, -16, -15) * 9 + /* 17º Nº */substr($chaveString, -17, -16) * 2 + /* 18º Nº */substr($chaveString, -18, -17) * 3 + /* 19º Nº */substr($chaveString, -19, -18) * 4 + /* 20º Nº */substr($chaveString, -20, -19) * 5 + /* 21º Nº */substr($chaveString, -21, -20) * 6 + /* 22º Nº */substr($chaveString, -22, -21) * 7 + /* 23º Nº */substr($chaveString, -23, -22) * 8 + /* 24º Nº */substr($chaveString, -24, -23) * 9 + /* 25º Nº */substr($chaveString, -25, -24) * 2 + /* 26º Nº */substr($chaveString, -26, -25) * 3 + /* 27º Nº */substr($chaveString, -27, -26) * 4 + /* 28º Nº */substr($chaveString, -28, -27) * 5 + /* 29º Nº */substr($chaveString, -29, -28) * 6 + /* 30º Nº */substr($chaveString, -30, -29) * 7 + /* 31º Nº */substr($chaveString, -31, -30) * 8 + /* 32º Nº */substr($chaveString, -32, -31) * 9 + /* 33º Nº */substr($chaveString, -33, -32) * 2 + /* 34º Nº */substr($chaveString, -34, -33) * 3 + /* 35º Nº */substr($chaveString, -35, -34) * 4 + /* 36º Nº */substr($chaveString, -36, -35) * 5 + /* 37º Nº */substr($chaveString, -37, -36) * 6 + /* 38º Nº */substr($chaveString, -38, -37) * 7 + /* 39º Nº */substr($chaveString, -39, -38) * 8 + /* 40º Nº */substr($chaveString, -40, -39) * 9 + /* 41º Nº */substr($chaveString, -41, -40) * 2 + /* 42º Nº */substr($chaveString, -42, -41) * 3 + /* 43º Nº */substr($chaveString, -43, -42) * 4;
        $cDV = $ponderacaoString % 11;
        /*
         * Se o resto da divisão for 0 ou 1 cDV=0
         * Senão cDV = 11- Resto da divisão
         * Adicionar a string NFe no inicio da chave de acesso
         */
        if ($cDV === 0 || $cDV === 1) 
        {
            $chaveDeAcesso = 'NFe' . $this->ide['cUF'] . $AAMM . $this->emit['CNPJ'] .
                $this->ide['mod'] . $this->ide['serie'] . $this->gerarNnf() . $this->ide['tpEmis'] . $this->gerarCnf() . '0';
        } 
        else 
        {
            $chaveDeAcesso = 'NFe' . $this->ide['cUF'] . $AAMM . $this->emit['CNPJ'] . $this->ide['mod'] .
                $this->ide['serie'] . $this->gerarNnf() . $this->ide['tpEmis'] . $this->gerarCnf() . (11 - $cDV);
        }
        return $chaveDeAcesso;
    }
    public function salvarNF($protocolo) 
    {   
        $table = 'nf';
        $id = $this->getId($table);
        $chave = $this->gerarChaveDeAcesso();
        $cNF = $this->gerarCnf();
        $nNF = $this->gerarNnf();
        $dhEmi = $this->getTime();
        $sql = "INSERT INTO nf (id,chave,cNF,nNF,protocolo,dhEmi) VALUES
        (:id,:chave,:cNF,:nNF,:protocolo,:dhEmi)";
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->prepare($sql);
            $stmt->execute
            (array(
                ':id' => $id,
                ':chave' => $chave,
                ':cNF' => $cNF,
                ':nNF' => $nNF,
                ':protocolo' => $protocolo,
                ':dhEmi' => $dhEmi
            ));
            $connection = null;
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    /*
    public function saidaProduto($produto)
    {
        $produtoOut = array();
        for($i=0; $i<count($produto);$i++)
        {
            $filtered = array_filter($produto[$i], function($v,$k) {
                return $k !== "NCM" && $k !== "CFOP" && $k !== "produto" && $k !== "preco" && $k !== "CFOP";
            }, ARRAY_FILTER_USE_BOTH);
            array_push($produtoOut,$filtered);
        } 
        // begin the sql statement
        $sql = "INSERT INTO saidaproduto (idproduto, quantidade ) VALUES ";
        
        $total = count($produtoOut);
        
        // this is where the magic happens
        $it = new ArrayIterator( $produtoOut );
        
        // Iterate over the values in the ArrayObject:
        while($it->valid()){
            $currentItem = $it->current();
            $sql .='('.$currentItem['id'].','.$currentItem['quantidade'].')';
            $it->next();
            $sql .= $it->key() ? ',' : ';';
        }
        $this->connection->consultar($sql);
        }
    public static function venda()
    {

    }
    */
    function autorizarXML($informacoesAdicionais, $arrayProduto,$dest,$pagamentos,$valorTotal) 
    {
        session_start();
        $dom = new DOMDocument('1.0', 'utf-8');
        $NFe = $dom->appendChild($dom->createElement('NFe'));
        $NFe->setAttributeNode(new DOMAttr('xmlns', 'http://www.portalfiscal.inf.br/nfe'));
        //<infNFe>
        $infNFe = $NFe->appendChild($dom->createElement('infNFe'));
        $infNFe->setAttributeNode(new DOMAttr('Id', $this->gerarChaveDeAcesso()));
        $infNFe->setAttributeNode(new DOMAttr('versao', '4.00'));
        //<ide>        
        $ide = $infNFe->appendChild($dom->createElement('ide'));
            $cUF = $ide->appendChild($dom->createElement('cUF'));
            $cUF->appendChild($dom->createTextNode($this->ide['cUF']));
            $cNF = $ide->appendChild($dom->createElement('cNF'));
            $cNF->appendChild($dom->createTextNode($this->gerarCnf()));
            $natOp = $ide->appendChild($dom->createElement('natOp'));
            $natOp->appendChild($dom->createTextNode($this->ide['natOp']));
            $mod = $ide->appendChild($dom->createElement('mod'));
            $mod->appendChild($dom->createTextNode($this->ide['mod']));
            $serie = $ide->appendChild($dom->createElement('serie'));
            $serie->appendChild($dom->createTextNode(substr($this->ide['serie'], -1, 1)));
            $nNF = $ide->appendChild($dom->createElement('nNF'));
            $nNF->appendChild($dom->createTextNode($this->gerarNnf()));
            $dhEmit = $ide->appendChild($dom->createElement('dhEmi'));
            $dhEmit->appendChild($dom->createTextNode($this->getTime()));
            $tpNF = $ide->appendChild($dom->createElement('tpNF'));
            $tpNF->appendChild($dom->createTextNode($this->ide['tpNF']));
            $idDest = $ide->appendChild($dom->createElement('idDest'));
            $idDest->appendChild($dom->createTextNode($this->ide['idDest']));
            $cMunFG = $ide->appendChild($dom->createElement('cMunFG'));
            $cMunFG->appendChild($dom->createTextNode($this->ide['cMunFG']));
            $tpImp = $ide->appendChild($dom->createElement('tpImp'));
            $tpImp->appendChild($dom->createTextNode($this->ide['tpImp']));
            $tpEmis = $ide->appendChild($dom->createElement('tpEmis'));
            $tpEmis->appendChild($dom->createTextNode($this->ide['tpEmis']));
            $cDV = $ide->appendChild($dom->createElement('cDV'));
            $cDV->appendChild($dom->createTextNode(substr($this->gerarChaveDeAcesso(), -1, 1)));
            $tpAmp = $ide->appendChild($dom->createElement('tpAmb'));
            $tpAmp->appendChild($dom->createTextNode($this->ide['tpAmb']));
            $finNFe = $ide->appendChild($dom->createElement('finNFe'));
            $finNFe->appendChild($dom->createTextNode($this->ide['finNFe']));
            $indFinal = $ide->appendChild($dom->createElement('indFinal'));
            $indFinal->appendChild($dom->createTextNode($this->ide['indFinal']));
            $indPres = $ide->appendChild($dom->createElement('indPres'));
            $indPres->appendChild($dom->createTextNode($this->ide['indPres']));
            $procEmi = $ide->appendChild($dom->createElement('procEmi'));
            $procEmi->appendChild($dom->createTextNode($this->ide['procEmi']));
            $verProc = $ide->appendChild($dom->createElement('verProc'));
            $verProc->appendChild($dom->createTextNode($this->ide['verProc']));
        //<emit>
        $emit = $infNFe->appendChild($dom->createElement('emit'));
            $CNPJEMIT = $emit->appendChild($dom->createElement('CNPJ'));
            $CNPJEMIT->appendChild($dom->createTextNode($this->emit['CNPJ']));
            $xNome = $emit->appendChild($dom->createElement('xNome'));
            $xNome->appendChild($dom->createTextNode($this->emit['xNome']));
            $xFant = $emit->appendChild($dom->createElement('xFant'));
            $xFant->appendChild($dom->createTextNode($this->emit['xFant']));
            //<enderEmit>    
            $enderEmit = $emit->appendChild($dom->createElement('enderEmit'));
            foreach ($this->enderEmit as $key => $value) 
            {
                $tag = $enderEmit->appendChild($dom->createElement($key));
                $tag->appendChild($dom->createTextNode($value));
            }
            //<emit>
            $IE = $emit->appendChild($dom->createElement('IE'));
            $IE->appendChild($dom->createTextNode($this->emit['IE']));
            $IM = $emit->appendChild($dom->createElement('IM'));
            $IM->appendChild($dom->createTextNode($this->emit['IM']));
            $CNAE = $emit->appendChild($dom->createElement('CNAE'));
            $CNAE->appendChild($dom->createTextNode($this->emit['CNAE']));
            $CRT = $emit->appendChild($dom->createElement('CRT'));
            $CRT->appendChild($dom->createTextNode($this->emit['CRT']));
        //Tag <dest>
        if($dest === true)
        {
            $destinatario = $infNFe->appendChild($dom->createElement('dest'));
                $CNPJDEST = $destinatario->appendChild($dom->createElement('CNPJ'));
                $CNPJDEST->appendChild($dom->createTextNode($this->dest['CNPJ']));
                $xNomeDEST = $destinatario->appendChild($dom->createElement('xNome'));
                $xNomeDEST->appendChild($dom->createTextNode('NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL'));
                //Tag <enderDest>
                $enderDestinatario = $destinatario->appendChild($dom->createElement('enderDest'));
                foreach ($this->enderDest as $key => $value) 
                {
                    $tag = $enderDestinatario->appendChild($dom->createElement($key));
                    $tag->appendChild($dom->createTextNode($value));
                }
            //Tag <dest>
                $indIEDest = $destinatario->appendChild($dom->createElement('indIEDest'));
                $indIEDest->appendChild($dom->createTextNode($this->dest['indIEDest']));
        }
        //Tag <det>
        if (count($arrayProduto) !== 0) 
        {
            for ($i = 0; $i < count($arrayProduto); $i++) 
            {
                $det = $infNFe->appendChild($dom->createElement('det'));
                $det->setAttributeNode(new DOMAttr('nItem', 1 + $i));
                    $prod = $det->appendChild($dom->createElement('prod'));
                    $cProd = $prod->appendChild($dom->createElement('cProd'));
                    $cProd->appendChild($dom->createTextNode($arrayProduto[$i]['Codigo']));
                    $cEAN = $prod->appendChild($dom->createElement('cEAN'));
                    $cEAN->appendChild($dom->createTextNode('SEM GTIN'));
                    $xProd = $prod->appendChild($dom->createElement('xProd'));
                    $xProd->appendChild($dom->createTextNode($arrayProduto[$i]['Descricao']));
                    $NCM = $prod->appendChild($dom->createElement('NCM'));
                    $NCM->appendChild($dom->createTextNode($arrayProduto[$i]['ncm']));
                    $CFOP = $prod->appendChild($dom->createElement('CFOP'));
                    $CFOP->appendChild($dom->createTextNode($arrayProduto[$i]['CFOP']));
                    $uCom = $prod->appendChild($dom->createElement('uCom'));
                    $uCom->appendChild($dom->createTextNode($arrayProduto[$i]['UN']));
                    $qCom = $prod->appendChild($dom->createElement('qCom'));
                    $qCom->appendChild($dom->createTextNode($arrayProduto[$i]['Qtd']));
                    $vUnCom = $prod->appendChild($dom->createElement('vUnCom'));
                    $vUnCom->appendChild($dom->createTextNode($arrayProduto[$i]['Vl Unit']));
                    $vProd = $prod->appendChild($dom->createElement('vProd'));
                    //Calcular valor total do produto - valor * quantidade\\
                    //Permitir somente duas casas depois da vírgula    printf('%.2f', round(1001.8, 2)) \\
                    $vProd->appendChild($dom->createTextNode(sprintf('%.2f', round($arrayProduto[$i]['Vl Unit'] * $arrayProduto[$i]['Qtd'],2))));
                    $cEANTrib = $prod->appendChild($dom->createElement('cEANTrib'));
                    $cEANTrib->appendChild($dom->createTextNode('SEM GTIN'));
                    $uTrib = $prod->appendChild($dom->createElement('uTrib'));
                    $uTrib->appendChild($dom->createTextNode($arrayProduto[$i]['UN']));
                    $qTrib = $prod->appendChild($dom->createElement('qTrib'));
                    $qTrib->appendChild($dom->createTextNode($arrayProduto[$i]['Qtd']));
                    $vUnTrib = $prod->appendChild($dom->createElement('vUnTrib'));
                    $vUnTrib->appendChild($dom->createTextNode($arrayProduto[$i]['Vl Unit']));
                    $indTot = $prod->appendChild($dom->createElement('indTot'));
                    $indTot->appendChild($dom->createTextNode(1));
                //Tag <imposto>    
                $imposto = $det->appendChild($dom->createElement('imposto'));
                    //Tag <ICMS>
                    $ICMS = $imposto->appendChild($dom->createElement('ICMS'));
                        $ICMSSN102 = $ICMS->appendChild($dom->createElement('ICMSSN102'));
                        $orig = $ICMSSN102->appendChild($dom->createElement('orig'));
                        $orig->appendChild($dom->createTextNode(0));
                        $CSOSN = $ICMSSN102->appendChild($dom->createElement('CSOSN'));
                        $CSOSN->appendChild($dom->createTextNode(102));
                    //Tag <PIS>                
                    $PIS = $imposto->appendChild($dom->createElement('PIS'));
                        $PISAliq = $PIS->appendChild($dom->createElement('PISOutr'));
                        $CSTPIS = $PISAliq->appendChild($dom->createElement('CST'));
                        $CSTPIS->appendChild($dom->createTextNode(99));
                        $vBCPIS = $PISAliq->appendChild($dom->createElement('vBC'));
                        $vBCPIS->appendChild($dom->createTextNode($this->PIS['vBC']));
                        $pPIS = $PISAliq->appendChild($dom->createElement('pPIS'));
                        $pPIS->appendChild($dom->createTextNode($this->PIS['pPIS']));
                        $vPIS = $PISAliq->appendChild($dom->createElement('vPIS'));
                        $vPIS->appendChild($dom->createTextNode($this->PIS['vPIS']));
                    //Tag <COFINS>
                    $COFINS = $imposto->appendChild($dom->createElement('COFINS'));
                        $COFINSAliq = $COFINS->appendChild($dom->createElement('COFINSOutr'));
                        $CSTCOFINS = $COFINSAliq->appendChild($dom->createElement('CST'));
                        $CSTCOFINS->appendChild($dom->createTextNode(99));
                        $vBCCOFINS = $COFINSAliq->appendChild($dom->createElement('vBC'));
                        $vBCCOFINS->appendChild($dom->createTextNode($this->COFINS['vBC']));
                        $pCOFINS = $COFINSAliq->appendChild($dom->createElement('pCOFINS'));
                        $pCOFINS->appendChild($dom->createTextNode($this->COFINS['pCOFINS']));
                        $vCOFINS = $COFINSAliq->appendChild($dom->createElement('vCOFINS'));
                        $vCOFINS->appendChild($dom->createTextNode($this->COFINS['vCOFINS']));
            }// Tag <det> - Final for
        } // Tag <det> - Final if(ount($array) !== 0)
        //Tag <total>
        $total = $infNFe->appendChild($dom->createElement('total'));
            $ICMSTot = $total->appendChild($dom->createElement('ICMSTot'));
                $vBC = $ICMSTot->appendChild($dom->createElement('vBC'));
                $vBC->appendChild($dom->createTextNode('0.00'));
                $vICMS = $ICMSTot->appendChild($dom->createElement('vICMS'));
                $vICMS->appendChild($dom->createTextNode('0.00'));
                $vICMSDeson = $ICMSTot->appendChild($dom->createElement('vICMSDeson'));
                $vICMSDeson->appendChild($dom->createTextNode('0.00'));
                $vFCP = $ICMSTot->appendChild($dom->createElement('vFCP'));
                $vFCP->appendChild($dom->createTextNode('0.00'));
                $vBCST = $ICMSTot->appendChild($dom->createElement('vBCST'));
                $vBCST->appendChild($dom->createTextNode('0.00'));
                $vST = $ICMSTot->appendChild($dom->createElement('vST'));
                $vST->appendChild($dom->createTextNode('0.00'));
                $vFCPST = $ICMSTot->appendChild($dom->createElement('vFCPST'));
                $vFCPST->appendChild($dom->createTextNode('0.00'));
                $vFCPSTRet = $ICMSTot->appendChild($dom->createElement('vFCPSTRet'));
                $vFCPSTRet->appendChild($dom->createTextNode('0.00'));
                $vProd = $ICMSTot->appendChild($dom->createElement('vProd'));
                $vProd->appendChild($dom->createTextNode(sprintf('%.2f', round($valorTotal,2))));
                $vFrete = $ICMSTot->appendChild($dom->createElement('vFrete'));
                $vFrete->appendChild($dom->createTextNode('0.00'));
                $vSeg = $ICMSTot->appendChild($dom->createElement('vSeg'));
                $vSeg->appendChild($dom->createTextNode('0.00'));
                $vDesc = $ICMSTot->appendChild($dom->createElement('vDesc'));
                $vDesc->appendChild($dom->createTextNode('0.00'));
                $vII = $ICMSTot->appendChild($dom->createElement('vII'));
                $vII->appendChild($dom->createTextNode('0.00'));
                $vIPI = $ICMSTot->appendChild($dom->createElement('vIPI'));
                $vIPI->appendChild($dom->createTextNode('0.00'));
                $vIPIDevol = $ICMSTot->appendChild($dom->createElement('vIPIDevol'));
                $vIPIDevol->appendChild($dom->createTextNode('0.00'));
                $vPIS = $ICMSTot->appendChild($dom->createElement('vPIS'));
                $vPIS->appendChild($dom->createTextNode('0.00'));
                $vCOFINS = $ICMSTot->appendChild($dom->createElement('vCOFINS'));
                $vCOFINS->appendChild($dom->createTextNode('0.00'));
                $vOutro = $ICMSTot->appendChild($dom->createElement('vOutro'));
                $vOutro->appendChild($dom->createTextNode('0.00'));
                $vNF = $ICMSTot->appendChild($dom->createElement('vNF'));
                $vNF->appendChild($dom->createTextNode(sprintf('%.2f', round($valorTotal,2))));
        //Trans
        $transporte = $infNFe->appendChild($dom->createElement('transp'));
            $modFrete = $transporte->appendChild($dom->createElement('modFrete'));
            $modFrete->appendChild($dom->createTextNode(9));
        //Tag <pag> Se for somente no dinheiro
        //Poderia se escolhido qualquer um dos arrays dentro de card
        if(empty($pagamentos))
        {
            if(empty($this->card['tpIntegra']))
            {   
                //Tag <pag>
                $pag = $infNFe->appendChild($dom->createElement('pag'));
                    $tagDetPag = $pag->appendChild($dom->createElement('detPag'));
                    $tPag = $tagDetPag->appendChild($dom->createElement('tPag'));
                    $tPag->appendChild($dom->createTextNode($this->detPag['tPag']));
                    $vPag = $tagDetPag->appendChild($dom->createElement('vPag'));
                    $vPag->appendChild($dom->createTextNode(sprintf('%.2f', round($this->detPag['vPag'],2))));
            } else if(!empty($this->card['tpIntegra'])) //Se for somente no cartão
            {
                //Tag <pag> SE FOR CARTÃO
                $pag = $infNFe->appendChild($dom->createElement('pag'));
                    $tagDetPag = $pag->appendChild($dom->createElement('detPag'));
                        $tPag = $tagDetPag->appendChild($dom->createElement('tPag'));
                        $tPag->appendChild($dom->createTextNode($this->detPag['tPag']));
                        $vPag = $tagDetPag->appendChild($dom->createElement('vPag'));
                        $vPag->appendChild($dom->createTextNode(sprintf('%.2f', round($this->detPag['vPag'],2))));
                        //Tag <card>
                        $cardInfo = $tagDetPag->appendChild($dom->createElement('card'));
                        foreach ($this->card as $key => $value) 
                        {
                            $tag = $cardInfo->appendChild($dom->createElement($key));
                            $tag->appendChild($dom->createTextNode($value));
                        }
            }
        }
        /*
        Duas Formas de Pagamentos:
        array $Pagamentos vem da rota /uninfe/autorizar contendo as duas formas de pagamentos
        */ 
        if(!empty($pagamentos))
        {
            //Tag <pag>
            $pag = $infNFe->appendChild($dom->createElement('pag'));
                $tagDetPag = $pag->appendChild($dom->createElement('detPag'));
                $tPag = $tagDetPag->appendChild($dom->createElement('tPag'));
                $tPag->appendChild($dom->createTextNode(99));
                $vPag = $tagDetPag->appendChild($dom->createElement('vPag'));
                $vPag->appendChild($dom->createTextNode(sprintf('%.2f', round($valorTotal,2)))); 
        }
        // END <pag>
        //<infAdic>
        $infAdic = $infNFe->appendChild($dom->createElement('infAdic'));
        $infCpl = $infAdic->appendChild($dom->createElement('infCpl'));
        if(!empty($informacoesAdicionais))
        {
            $infCpl->appendChild($dom->createTextNode($informacoesAdicionais = trim(preg_replace('/\s+/', ' ', $informacoesAdicionais))));
        }else{
            $infCpl->appendChild($dom->createTextNode('Informações da Empresa, caso seja venda com uma forma de pagamento'));
        }
        $dom->save($this->gerarChaveDeAcesso() . '-nfe.xml');
    }
    function cancelarXml($protocolo, $chave) 
    {
        $table = 'nfCancelada';
        $dom = new DOMDocument('1.0', 'utf-8');
        $envEvento = $dom->appendChild($dom->createElement('envEvento'));
        $envEvento->setAttributeNode(new DOMAttr('versao', '1.00'));
        $envEvento->setAttributeNode(new DOMAttr('xmlns', 'http://www.portalfiscal.inf.br/nfe'));
            $idLote = $envEvento->appendChild($dom->createElement('idLote'));
            $idLote->appendChild($dom->createTextNode($this->getId($table)));
            $evento = $envEvento->appendChild($dom->createElement('evento'));
            $evento->setAttributeNode(new DOMAttr('versao', '1.00'));
            $evento->setAttributeNode(new DOMAttr('xmlns', 'http://www.portalfiscal.inf.br/nfe'));
            $infEvento = $evento->appendChild($dom->createElement('infEvento'));
            $infEvento->setAttributeNode(new DOMAttr('Id', 'ID'.$this->tpEvento.substr_replace($chave,'', 0, 3).'0'.$this->nSeqEvento));
                $cOrgao = $infEvento->appendChild($dom->createElement('cOrgao'));
                $cOrgao->appendChild($dom->createTextNode(43));
                $tpAmb = $infEvento->appendChild($dom->createElement('tpAmb'));
                $tpAmb->appendChild($dom->createTextNode(2));
                $CNPJ = $infEvento->appendChild($dom->createElement('CNPJ'));
                $CNPJ->appendChild($dom->createTextNode($this->emit['CNPJ']));
                $chNFe = $infEvento->appendChild($dom->createElement('chNFe'));
                $chNFe->appendChild($dom->createTextNode(substr_replace($chave,'', 0, 3)));
                $dhEvento = $infEvento->appendChild($dom->createElement('dhEvento'));
                $dhEvento->appendChild($dom->createTextNode($this->getTime()));
                $tpEvento = $infEvento->appendChild($dom->createElement('tpEvento'));
                $tpEvento->appendChild($dom->createTextNode($this->tpEvento));
                $nSeqEvento = $infEvento->appendChild($dom->createElement('nSeqEvento'));
                $nSeqEvento->appendChild($dom->createTextNode($this->nSeqEvento));
                $verEvento = $infEvento->appendChild($dom->createElement('verEvento'));
                $verEvento->appendChild($dom->createTextNode('1.00'));
                $detEvento = $infEvento->appendChild($dom->createElement('detEvento'));
                $detEvento->setAttributeNode(new DOMAttr('versao', '1.00'));
                    $descEvento = $detEvento->appendChild($dom->createElement('descEvento'));
                    $descEvento->appendChild($dom->createTextNode('Cancelamento'));
                    $nProt = $detEvento->appendChild($dom->createElement('nProt'));
                    $nProt->appendChild($dom->createTextNode($protocolo));
                    $xJust = $detEvento->appendChild($dom->createElement('xJust'));
                    $xJust->appendChild($dom->createTextNode('Colocar Algum Motivo Escrito Pelo Usuario'));
        $dom->save($chave.'-ped-eve.xml');        
    }
    public function inutilizarXml($inicio,$fim,$just)
    {
        $id = $this->ide['cUF'].date('y').$this->emit['CNPJ'].$this->ide['mod'].$this->ide['serie'].$inicio.$fim;
        $dom = new DOMDocument('1.0','utf-8');
        $inutNFe = $dom->appendChild($dom->createElement('inutNFe'));
        $inutNFe->setAttributeNode(new DOMAttr('xmlns','http://www.portalfiscal.inf.br/nfe'));
        $inutNFe->setAttributeNode(new DOMAttr('versao','4.00'));
            $infInut   = $inutNFe->appendChild($dom->createElement('infInut'));
            $infInut ->setAttributeNode(new DOMAttr('Id','ID'.$id));                
                $tpAmb = $infInut->appendChild($dom->createElement('tpAmb'));
                $tpAmb->appendChild($dom->createTextNode($this->ide['tpAmb']));
                $xServ = $infInut->appendChild($dom->createElement('xServ'));
                $xServ->appendChild($dom->createTextNode('INUTILIZAR'));
                $cUF = $infInut->appendChild($dom->createElement('cUF'));
                $cUF->appendChild($dom->createTextNode($this->ide['cUF']));
                $ano = $infInut->appendChild($dom->createElement('ano'));
                $ano->appendChild($dom->createTextNode(date('y')));
                $CNPJ = $infInut->appendChild($dom->createElement('CNPJ'));
                $CNPJ->appendChild($dom->createTextNode($this->emit['CNPJ']));
                $mod = $infInut->appendChild($dom->createElement('mod'));
                $mod->appendChild($dom->createTextNode($this->ide['mod']));
                $serie = $infInut->appendChild($dom->createElement('serie'));
                $serie->appendChild($dom->createTextNode(substr($this->ide['serie'], -1, 1)));
                $nNFIni = $infInut->appendChild($dom->createElement('nNFIni'));
                $nNFIni->appendChild($dom->createTextNode($inicio));
                $nNFFin = $infInut->appendChild($dom->createElement('nNFFin'));
                $nNFFin->appendChild($dom->createTextNode($fim));
                $xJust = $infInut->appendChild($dom->createElement('xJust'));
                $xJust->appendChild($dom->createTextNode($just));
        $dom->save($id.'-ped-inu.xml'); 
    }
}