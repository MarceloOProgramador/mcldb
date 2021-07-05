<center><h2> DESCRIPTION </h2></center>

<p>
    This libary is a simple database CRUD with some functions.
    It is created with private intention of studying php by <strong>Marcelo Pereira</strong>.
    github: https://github.com/MarceloOProgramador; 
    e-mail: marceloopromador@gmail.com
</p>

<ul>
    <li>CURRENT VERSION <strong>1.0.0</strong></li>
    <li>LICENSE <strong>MIT</strong></li>
</ul>

---

<center><h2> EXAMPLES </h2></center>

<h3>INSERT EXAMPLE</h3>
<p>
$create_instance = new Create();<br>
$user = [<br>
    "name"  => "Example name",<br>
    "email" => "example@example.com"<br>
];<br>
$table_name = "users";<br>
<br>
$create_instance->toCreate($table_name, $user);<br>
$create_instance->exec(); //method return boolean value<br>
</p>

---

<h3>READ EXAMPLE</h3>
$read_instance = new Read();<br>
$table_example = "users";<br>
$read_instance->toRead($table_example)->where("id", "=", 1);<br>
$user = $read_instance->fetch(); //return array<br>
<br>

---

<h3>UPDATE EXAMPLE</h3>
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

---

<h3>DELETE EXAMPLE</h3>
$table_name = "users";<br>
$read_instance = new Read();<br>
$delete_instance = new Delete();<br>
<br>
$read_instance->toRead($table_name)->where("id", "=", 1);<br>
$user = $read_instance->fetch()[0]; <br>
<br>
$delete_instance->toDelete($table_name)->where("id", "=", $user["id"]);<br>
$delete_instance->exec();<br>

