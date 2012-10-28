<?php

//VSEBUJE $username IN $password ZA BAZO 
include "../../dbcreds.php";

$sitePot = "../sl-SI_joomla_lang_full_3.0.1v1/site_sl-SI";
$adminPot = "../sl-SI_joomla_lang_full_3.0.1v1/admin_sl-SI";
$site = scandir($sitePot);
$admin = scandir($adminPot);

$con = mysql_connect("127.0.0.1",$username,$password);
mysql_select_db("prevod");

foreach($site as $file) {
 if(substr($file,-4)==".ini") {
  $vsebina = file_get_contents($sitePot."/".$file);

  $r = mysql_query("
   SELECT * FROM zamenjaj;
  ");
  $n = mysql_num_rows($r);

  for($i=0; $i<$n; $i++) {
   $v = mysql_fetch_assoc($r);
   $vsebina = str_replace($v['kaj'],$v['sCim'],$vsebina);
  }
  
  file_put_contents($sitePot."/".$file, $vsebina);
 }
}

foreach($admin as $file) {
 if(substr($file,-4)==".ini") {
  $vsebina = file_get_contents($adminPot."/".$file);

  $r = mysql_query("
   SELECT * FROM zamenjaj;
  ");
  $n = mysql_num_rows($r);

  for($i=0; $i<$n; $i++) {
   $v = mysql_fetch_assoc($r);
   $vsebina = str_replace($v['kaj'],$v['sCim'],$vsebina);
  }

  file_put_contents($adminPot."/".$file, $vsebina);
 }
}

mysql_close($con);

?>
