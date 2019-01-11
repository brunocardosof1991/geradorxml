<?php
use App\Model\Xml;
require_once $_SERVER['DOCUMENT_ROOT'] . 'vendor/autoload.php';

$xml = new Xml();
/*
$dom = new DOMDocument('1.0', 'utf-8');
$NFe = $dom->appendChild($dom->createElement('NFe'));
$emit = $NFe->appendChild($dom->createElement('emit'));
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
$dom->save('teste' . '-nfe.xml');
*/


   