# Description
This libary is a simple database CRUD with some functions.
It is created with private intention of studying php by **Marcelo Pereira**.

- Github: https://github.com/MarceloOProgramador
- E-mail: marceloopromador@gmail.com

- CURRENT VERSION: 1.0.0
- LICENSE: MIT

---

## EXAMPLES 

#### INSERT EXAMPLE

```
$create_instance = new Create();  
$user = [
    "name"  => "Example name",
    "email" => "example@example.com"
];
$table_name = "users";

$create_instance->toCreate($table_name, $user);
$create_instance->exec(); //method return boolean value
```

---

### READ EXAMPLE

```
$read_instance = new Read();
$table_example = "users";
$read_instance->toRead($table_example)->where("id", "=", 1);
$user = $read_instance->fetch(); //return array

```
---

### UPDATE EXAMPLE

```
$table_name = "users";<br>
$update_instance = new Update();<br>
$read_instance = new Read();<br>
<br>
$read_instance->toRead($table_name)->where("id", "=", 1);<br>
$user = $read_instance->fetch()[0]; //return array<br>
<br>
$user["name"] = "Name updated";<br>
$user["email"] = "update@update.com";<br>
<br>
$update_instance->toUpdate($table_name, $user)->where("id", "=", $user["id"]);<br>
$update_instance->exec();<br>
<br>

$user["name"] = "Name updated";
$user["email"] = "update@update.com";

$update_instance->toUpdate($table_name, $user)->where("id", "=", $user["id"]);
$update_instance->exec();
```

---

### DELETE EXAMPLE

```
$table_name = "users";<br>
$read_instance = new Read();<br>
$delete_instance = new Delete();<br>
<br>
$read_instance->toRead($table_name)->where("id", "=", 1);<br>
$user = $read_instance->fetch()[0]; <br>
<br>
$delete_instance->toDelete($table_name)->where("id", "=", $user["id"]);<br>
$delete_instance->exec();<br>
```
