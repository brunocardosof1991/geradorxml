<?php
namespace App\Model;
class COFINS{
    public static $COFINSAliq = array 
    (
        'CST' => '99',
        'vBC' => '0.00',
        'pCOFINS' => '0.0000',
        'vCOFINS' => '0.00'
    );
    public $COFINSQtde = array 
    (
        'CST' => 'DEFAULT',
        'qBCProd' => 'DEFAULT',
        'vAliqProd' => 'DEFAULT',
        'vCOFINS' => 'DEFAULT',
        'COFINSNT' => 'DEFAULT',
        'CST' => 'DEFAULT'
    );
    public $COFINSOutr = array 
    (
        'CST' => 'DEFAULT',
        'vBC' => 'DEFAULT',
        'pCOFINS' => 'DEFAULT',
        'qBCProd' => 'DEFAULT',
        'vAliqProd' => 'DEFAULT',
        'vCOFINS' => 'DEFAULT'
    );
    public $COFINSST = array 
    (
        'vBC' => 'DEFAULT',
        'pCOFINS' => 'DEFAULT',
        'qBCProd' => 'DEFAULT',
        'vAliqProd' => 'DEFAULT',
        'vCOFINS' => 'DEFAULT'
    );
}

