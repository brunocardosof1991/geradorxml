<?php
use App\Model\Conexao;
use App\Model\ICMS;
use App\Model\PIS;
use App\Model\COFINS;
use App\Model\Xml;
require_once $_SERVER['DOCUMENT_ROOT'] . '../../vendor/autoload.php';

$object = new \App\Model\PIS();
print_r(PIS::$PISOutr);