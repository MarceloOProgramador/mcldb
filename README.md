# DESCRIPTION
This libary is a simple database CRUD with some functions.
It is created with private intention of studying php by Marcelo Pereira
github: https://github.com/MarceloOProgramador; 
e-mail: marceloopromador@gmail.com

#CURRENT VERSION 1.0.0

#LICENSE MIT

#EXAMPLES

#INSERT EXAMPLE
$create_instance = new Create($host, $user, $pass, $database);
$user = [
    "name"  => "Example name",
    "email" => "example@example.com"
];
$table_name = "users";

$create_instance->toCreate($table_name, $user);
$create_instance->exec(); //method return boolean value


#READ EXAMPLE
$read_instance = new Read($host, $user, $pass, $database);
$table_example = "users";
$read_instance->toRead($table_example)->where("id", "=", 1);
$user = $read_instance->fetch(); //return array

#UPDATE EXAMPLE
$table_name = "users";
$update_instance = new Update($host, $user, $pass, $database);
$read_instance = new Read($host, $user, $pass, $database);

$read_instance->toRead($table_name)->where("id", "=", 1);
$user = $read_instance->fetch()[0]; //return array

$user["name"] = "Name updated";
$user["email"] = "update@update.com";

$update_instance->toUpdate($table_name, $user)->where("id", "=", $user["id"]);
$update_instance->exec();

#DELETE EXAMPLE
$table_name = "users";
$read_instance = new Read($host, $user, $pass, $database);
$delete_instance = new Delete($host, $user, $pass, $database);

$read_instance->toRead($table_name)->where("id", "=", 1);
$user = $read_instance->fetch()[0]; 

$delete_instance->toDelete($table_name)->where("id", "=", $user["id"]);
$delete_instance->exec();

