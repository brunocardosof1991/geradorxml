<?php
namespace App\Model;
class PIS {
    public static $PISAliq = array 
    (
        'CST' => '99',
        'vBC' => '0.00',
        'pPIS' => '0.0000',
        'vPIS' => '0.00'
    );
    public $PISQtde = array 
    (
        'CST' => 'DEFAULT',
        'qBCProd' => 'DEFAULT',
        'vAliqProd' => 'DEFAULT',
        'vPIS' => 'DEFAULT',
        'PISNT' => 'DEFAULT',
        'CST' => 'DEFAULT'
    );
    public $PISOutr = array 
    (
        'CST' => 'DEFAULT',
        'vBC' => 'DEFAULT',
        'pPIS' => 'DEFAULT',
        'qBCProd' => 'DEFAULT',
        'vAliqProd' => 'DEFAULT',
        'vPIS' => 'DEFAULT'
    );
    public $PISST = array 
    (
        'vBC' => 'DEFAULT',
        'pPIS' => 'DEFAULT',
        'qBCProd' => 'DEFAULT',
        'vAliqProd' => 'DEFAULT',
        'vPIS' => 'DEFAULT'
    );
}
