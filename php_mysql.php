<?php
class connectionTest {
public $servername = "oniddb.cws.oregonstate.edu";
public $username = "carringl-db";
public $password = "10VGEvyfesvu52XN";
public $database = "carringl-db";}

$connection = new connectionTest;
//create connection
$db = new mysqli($connection->servername, $connection->username, $connection->password, $connection->database);

//check connection
if ($db->connect_error) {
    die("connection failed: " . $db->connect_error);}
//else{
    //echo "Connection Successful";}

//mysqli_selsect_db("carringl-db");
$sql = $db->query("SELECT name, category, length, rented FROM videoCheckout");
echo "<table>";
while($row = $sql->fetch_object()){
    echo "<tr>";
    echo "<td> $row->name</td>";
    echo "<td> $row->category</td>";
    echo "<td> $row->length</td>";
    echo "<td> $row->rented</td>";
   // echo "<td> <form method='POST'> <input type= 'submit' value ='Delete Record'> </form></td>";
    echo "</tr>";}
echo "</table>";


echo "<form method='post'>";
echo "CHECK-IN MOVIE HERE<br>";
echo "name<input type='text' maxlength='255' name='name' ></br>";
echo "category<input type='text' maxlength='255' name='category'></br>";
echo "length<input type='number' name='length'></br>";
echo "rented<input type='checkbox' name='rented'></br>";
echo "<input type='submit' name='submit' value='Deposit Movie'>";   
echo "</form>";

$tname = $_POST['name'];
$tcategory = $_POST['category'];
$tlength = $_POST['length'];
$trented = $_POST['rented'];
//insert();

//function insert(){
$query = "INSERT INTO videoCheckout (name, category, length, rented) VALUES (?,?,?,?)";
$stmt = $db->prepare($query);
$stmt->bind_param('ssib', $tname, $tcategory, $tlength, $trented);

if($stmt->execute()){
    echo "Success!";}
//$newId = $ssmt->insert_id;
$stmt->close();

$dbi->close();
?>
