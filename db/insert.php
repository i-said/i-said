<?php
ini_set('mbstring.internal_encoding' , 'UTF-8');

$file_name = 'nasadata';
$file = $file_name . ".tsv";
$sql_file = "sql_file-nasa.sql";



setlocale(LC_ALL, 'ja_JP.UTF-8');
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
  // if ($i === 0){
  //   continue;
  // }

  if ($data === ""){
    continue;
  }
  $lat = $data[0];
  $lng = $data[1];
  $image_url = $data[2];
  $desc = $data[3];
  $name = str_replace("http://dbpedia.org/resource/", "",$data[3]);
  $name = str_replace("Třebíč", "Trebic",$data[3]);
  $name = str_replace("Třebí�?", "Trebic",$data[3]);

  $sql .= insert($name, $desc, $lat, $lng, $image_url);
}
//ファイルを作成
$fp = fopen($sql_file, "w");

// $sql = mb_convert_encoding($sql, "SJIS", "AUTO");
fwrite($fp, $sql);
fclose($temp);


function insert($name, $desc, $lat, $lng, $url){
  $sql = "insert into poi ( name, description, location, image) values (\" ". $name .  "\", \"" . $desc . "\", GeomFromText(\"POINT(". $lng . " " . $lat . ")\"), \"" . $url . "\");";
  echo $sql;
  return $sql . "\n";
}






?>
