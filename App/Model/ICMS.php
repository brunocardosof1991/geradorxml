<?php
namespace App\Model;
class ICMS {
    public $ICMS00 = array
    (
        'orig' => 'DEFAULT',
        'CST' => 'DEFAULT',
        'modBC' => 'DEFAULT',
        'vBC' => 'DEFAULT',
        'pICMS' => 'DEFAULT',
        'vICMS' => 'DEFAULT'
    );
    public $ICMS10 = array
    (
        'orig' => 'DEFAULT',
        'CST' => 'DEFAULT',
        'modBC' => 'DEFAULT',
        'vBC' => 'DEFAULT',
        'pICMS' => 'DEFAULT',
        'vICMS' => 'DEFAULT',
        'modBCST' => 'DEFAULT',
        'pMVAST' => 'DEFAULT',
        'pRedBCST' => 'DEFAULT',
        'vBCST' => 'DEFAULT',
        'pICMSST' => 'DEFAULT',
        'vICMSST' => 'DEFAULT'
    );
    public $ICMS20 = array
    (
        'orig' => 'DEFAULT',
        'CST' => 'DEFAULT',
        'modBC' => 'DEFAULT',
        'pRedBC' => 'DEFAULT',
        'vBC' => 'DEFAULT',
        'pICMS' => 'DEFAULT',
        'vICMS' => 'DEFAULT',
        'vICMSDeson' => 'DEFAULT',
        'motDesICMS' => 'DEFAULT'
    );
    public $ICMS30 = array
    (
        'orig' => 'DEFAULT',
        'CST' => 'DEFAULT',
        'modBCST' => 'DEFAULT',
        'pMVAST' => 'DEFAULT',
        'pRedBCST' => 'DEFAULT',
        'vBCST' => 'DEFAULT',
        'pICMSST' => 'DEFAULT',
        'vICMSST' => 'DEFAULT',
        'vICMSDeson' => 'DEFAULT',
        'motDesICMS' => 'DEFAULT'
    );
    //ICMS= 40, 41. 50
    public $ICMS40 = array
    (
        'orig' => 'DEFAULT',
        'CST' => 'DEFAULT',
        'vICMSDeson' => 'DEFAULT',
        'motDesICMS' => 'DEFAULT'
    );
    public $ICMS51 = array
    (
        'orig' => 'DEFAULT',
        'CST' => 'DEFAULT',
        'modBC' => 'DEFAULT',
        'pRedBC' => 'DEFAULT',
        'vBC' => 'DEFAULT',
        'pICMS' => 'DEFAULT',
        'vICMSOp' => 'DEFAULT',
        'pDif' => 'DEFAULT',
        'vICMSDif' => 'DEFAULT',
        'vICMS' => 'DEFAULT'
    );
    public $ICMS60 = array
    (
        'orig' => 'DEFAULT',
        'CST' => 'DEFAULT',
        'vBCSTRet' => 'DEFAULT',
        'vICMSSTRet' => 'DEFAULT'
    );
    public $ICMS70 = array
    (
        'orig' => 'DEFAULT',
        'CST' => 'DEFAULT',
        'modBC' => 'DEFAULT',
        'pRedBC' => 'DEFAULT',
        'vBC' => 'DEFAULT',
        'pICMS' => 'DEFAULT',
        'vICMS' => 'DEFAULT',
        'modBCST' => 'DEFAULT',
        'pMVAST' => 'DEFAULT',
        'pRedBCST' => 'DEFAULT',
        'vBCST' => 'DEFAULT',
        'pICMSST' => 'DEFAULT',
        'vICMSST' => 'DEFAULT',
        'vICMSDeson' => 'DEFAULT',
        'motDesICMS' => 'DEFAULT'
    );
    public $ICMS90 = array
    (
        'orig' => 'DEFAULT',
        'CST' => 'DEFAULT',
        'modBC' => 'DEFAULT',
        'vBC' => 'DEFAULT',
        'pRedBC' => 'DEFAULT',
        'pICMS' => 'DEFAULT',
        'vICMS' => 'DEFAULT',
        'modBCST' => 'DEFAULT',
        'pMVAST' => 'DEFAULT',
        'pRedBCST' => 'DEFAULT',
        'vBCST' => 'DEFAULT',
        'pICMSST' => 'DEFAULT',
        'vICMSST' => 'DEFAULT',
        'vICMSDeson' => 'DEFAULT',
        'vICMSDeson' => 'DEFAULT',
        'motDesICMS' => 'DEFAULT'
    );
    //Grupo de Partilha do ICMS
    public $ICMSPart = array
    (
        'orig' => 'DEFAULT',
        'CST' => 'DEFAULT',
        'modBC' => 'DEFAULT',
        'vBC' => 'DEFAULT',
        'pRedBC' => 'DEFAULT',
        'pICMS' => 'DEFAULT',
        'vICMS' => 'DEFAULT',
        'modBCST' => 'DEFAULT',
        'pMVAST' => 'DEFAULT',
        'pRedBCST' => 'DEFAULT',
        'vBCST' => 'DEFAULT',
        'pICMSST' => 'DEFAULT',
        'vICMSST' => 'DEFAULT',
        'pBCOp' => 'DEFAULT',
        'UFST' => 'DEFAULT'
    );
    //Grupo de Repasse do ICMS ST
    public $ICMSST = array
    (
        'orig' => 'DEFAULT',
        'CST' => 'DEFAULT',
        'vBCSTRet' => 'DEFAULT',
        'vICMSSTRet' => 'DEFAULT',
        'vBCSTDest' => 'DEFAULT',
        'vICMSSTDest' => 'DEFAULT'
    );
    //Grupo CRT=1
    public $ICMSSN101 = array
    (
        'orig' => 'DEFAULT',
        'CSOSN' => 'DEFAULT',
        'pCredSN' => 'DEFAULT',
        'vCredICMSSN' => 'DEFAULT'
    );
    public static $ICMSSN102 = array
    (
        'orig' => '0',
        'CSOSN' => '102'
    );
    public $ICMSSN201 = array
    (
        'orig' => 'DEFAULT',
        'CSOSN' => 'DEFAULT',
        'modBCST' => 'DEFAULT',
        'pMVAST' => 'DEFAULT',
        'pRedBCST' => 'DEFAULT',
        'vBCST' => 'DEFAULT',
        'pICMSST' => 'DEFAULT',
        'vICMSST' => 'DEFAULT',
        'pCredSN' => 'DEFAULT',
        'vCredICMSSN' => 'DEFAULT'
    );
    public $ICMSSN202 = array
    (
        'orig' => 'DEFAULT',
        'CSOSN' => 'DEFAULT',
        'modBCST' => 'DEFAULT',
        'pMVAST' => 'DEFAULT',
        'pRedBCST' => 'DEFAULT',
        'vBCST' => 'DEFAULT',
        'pICMSST' => 'DEFAULT',
        'vICMSST' => 'DEFAULT'
    );
    public $ICMSSN500 = array
    (
        'orig' => 'DEFAULT',
        'CSOSN' => 'DEFAULT',
        'vBCSTRet' => 'DEFAULT',
        'vICMSSTRet' => 'DEFAULT'
    );
    public $ICMSSN900 = array
    (
        'orig' => 'DEFAULT',
        'CSOSN' => 'DEFAULT',
        'modBC' => 'DEFAULT',
        'vBC' => 'DEFAULT',
        'pRedBC' => 'DEFAULT',
        'pICMS' => 'DEFAULT',
        'vICMS' => 'DEFAULT',
        'modBCST' => 'DEFAULT',
        'pMVAST' => 'DEFAULT',
        'pRedBCST' => 'DEFAULT',
        'vBCST' => 'DEFAULT',
        'pICMSST' => 'DEFAULT',
        'vICMSST' => 'DEFAULT',
        'pCredSN' => 'DEFAULT',
        'vCredICMSSN' => 'DEFAULT'
    );
}