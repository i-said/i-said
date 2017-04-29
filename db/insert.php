<?php
ini_set('mbstring.internal_encoding' , 'UTF-8');

// $i=0;
// while (($line = fgetcsv($fp)) !== FALSE) {
//     $line = mb_convert_encoding($line,"utf-8","sjis");
//     echo $line[0];
// }
//
// fclose($fp);
//$sql = '';
//exec()
setlocale(LC_ALL, 'ja_JP.UTF-8');
$file_name = 'world';
$file = $file_name . ".tsv";
$data = file_get_contents($file);
$data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');

$temp = tmpfile();
$csv  = array();

fwrite($temp, $data);
rewind($temp);
$i = -1;
$sql = "";
while (($data = fgetcsv($temp, 0, "\t")) !== FALSE) {
  $i++;
  if ($i === 0){
    continue;
  }

  if ($data === ""){
    continue;
  }
  $lat = $data[0];
  $lng = $data[1];
  $image_url = $data[2];
  $name = str_replace("http://dbpedia.org/resource/", "",$data[3]);
  $name = str_replace("Třebíč", "Trebic",$data[3]);
  $name = str_replace("Třebí�?", "Trebic",$data[3]);
  // $name = str_replace(""", "\"",$name);

  // echo $i . ' ' . $lat . ' ' . $lng  . "\n";
  $sql .= insert($name, "hoge", $lat, $lng, $image_url);
}
//ファイルを作成
$sql_file = "sql_file.sql";
$fp = fopen($sql_file, "w");

$sql = mb_convert_encoding($sql, "SJIS", "AUTO");
fwrite($fp, $sql);
fclose($temp);


function insert($name, $desc, $lat, $lng, $url){
  $sql = "insert into poi ( name, description, location, image) values (\" ". $name .  "\", \"" . $desc . "\", GeomFromText(\"POINT(". $lng . " " . $lat . ")\"), \"" . $url . "\");";
  return $sql . "\n";
}






?>
