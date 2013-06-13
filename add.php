<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
 
//only do anything if referer is legit
if($_SERVER['HTTP_REFERER']=="http://tyler-g.com/snips/"){

$snip = $_POST['snip'];
$type = $_POST['type'];

//load xml
$doc = new DOMDocument(); 
$doc->load( 'admin/new-snips.xml' ); 
$doc->formatOutput = true;

//
$snips = $doc->getElementsByTagName( "snips" );

//create new snip node
$newsnip = $doc->createElement('snip');
$newsnip = $snips->item(0)->appendChild($newsnip);

//create new type node (within new snip)
$newtype = $doc->createElement('type');
$newtype = $newsnip->appendChild($newtype);

//create new code node (within new snip)
$newcode = $doc->createElement('code');
$newcode = $newsnip->appendChild($newcode);


$typetext = $doc->createTextNode($type);
$typetext = $newtype->appendChild($typetext);

$cdata = $doc->createCDATASection($snip);
$cdata = $newcode->appendChild($cdata);



$doc->saveXML(); 
$doc->save("admin/new-snips.xml") ;


}





?>