
<?php

try{

$baglanti=new PDO("mysql:host=localhost; dbname=ders_programi_projesi",'root','');

}
catch(Exception $e){

echo $e->getMessage();

}

?>