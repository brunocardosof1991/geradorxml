<?php

$fileJSON = file_get_contents('teste.json');
$fileArray = json_decode($fileJSON,true);
print_r($fileArray[0]);