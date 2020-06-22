<?php

 $fields = "";
 $values = "";
 $params = ["name" => "marcelo", "email" => "marcelo@gmail.com", "phone" => "12990634859"];
//statement = INSERT INTO (name, email, phone) VALUES ("marcelo", "marcelo@gmail.com", "12996034859"); 
foreach ($params as $key => $value) {
    $fields .= $key.', ';
    $values .= ':'.$key.', ';
    $arrayExecute[":{$key}"] = $value;
}    


$fields = substr($fields, 0, -2);
print $fields."<br>";
print $values = substr($values, 0, -2);
print $values."<br>";
print "statemente = INSERT INTO {$fields} VALUES {$values}";
print "<br><pre>";
var_dump($arrayExecute);
print "</pre>";