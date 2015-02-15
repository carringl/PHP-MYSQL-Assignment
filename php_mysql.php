<?php

class connectionTest {
public $servername = "oniddb.cws.oregonstate.edu";
public $username = "carringl-db";
public $password = "10VGEvyfesvu52XN";
public $database = "carringl-db";}

$connection = new connectionTest;
$db = new mysqli($connection->servername, $connection->username, $connection->password, $connection->database);

//check connection
if ($db->connect_error) {
    die("connection failed: " . $db->connect_error);}

$sql = $db->query("SELECT id, name, category, length, irented FROM videoCheckout");
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<td> ID </td>";
echo "<td> name </td>";
echo "<td> category </td>";
echo "<td> length </td>";
//echo "<td> rented </td>";
echo "<td> <form method='POST'><input type='submit' name= 'delAll' value = 'Delete All Records'></form>";  
if(isset($_POST['delAll'])){
    //echo "this works";
    $query = "DELETE FROM videoCheckout";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $row->name);
    if($stmt->execute()){
        echo "All Records Successfully Deleted";}
    $stmt->close();}
echo "</tr> </thead>";
while($row = $sql->fetch_object()){
    echo "<tr>";
    echo "<td> $row->id </td>";
    echo "<td> $row->name</td>";
    echo "<td> $row->category</td>";
    echo "<td> $row->length</td>";
    //$rented = 0;
    echo "<td>";
    if($row->irented == 0){
        echo "<form method='POST'><input type='submit' name = 'rent_check' value='Check Out'></form>";
        if (isset($_POST['rent_check'])) {
            $trented = 1;
            $ROWID = $row->id;
            $query1 = "UPDATE videoCheckout SET irented=? WHERE id=?";
            $stmt = $db->prepare($query1);
            $stmt->bind_param('ii', $trented, $ROWID);
            if($stmt->execute()){
                echo "Record Saved.";}
            $stmt->close();
    }}
    elseif($row->irented == 1){
        echo "<form method='POST'><input type='submit' name='rent_check2' value='Check In'></form>";
        if (isset($_POST['rent_check2'])) {
            $trented = 0;
            $ROWID = $row->id;
            $query1 = "UPDATE videoCheckout SET irented=? WHERE id=?";
            $stmt = $db->prepare($query1);
            $stmt->bind_param('ii', $trented, $ROWID);
            if($stmt->execute()){
                echo "Record Saved.";}
            $stmt->close();
    }}
    echo '</td>';
    echo "<td> <form method='POST'><input type='submit' name= 'check1' value = 'Delete Record'></form>";  
    if(isset($_POST['check1'])){
             //echo "this works";
             $query = "DELETE FROM videoCheckout VALUES (?)";
             $stmt = $db->prepare($query);
             $stmt->bind_param('s', $row->name);
             if($stmt->execute()){
                 echo "Success!";}
             $stmt->close();}
        
   echo "</tr>";}
echo "</table>";


echo "<form method='post'>";
echo "CHECK-IN MOVIE HERE<br>";
echo "name<input type='text' maxlength='255' name='name' ></br>";
echo "category<input type='text' maxlength='255' name='category'></br>";
echo "length<input type='number' name='length'></br>";
//echo "rented<input type='checkbox' name='rented'></br>";
echo "<input type='submit' name='new_submit' value='Deposit Movie'>";   
echo "</form>";

function rented($irented) {
if($rented == 0){
echo "<input type='submit' name = 'rent_check' value='Check Out'>";
    if (isset($_POST['rent_check'])) {
    $rented = 1;}}
elseif($rented == 1){
echo "<input type='submit' name='rent_check2' value='Check In'>";
    if (isset($_POST['rent_check2'])) {
    $rented = 0;}}}

function insertData($db) {
$tname = $_POST['name'];
$tcategory = $_POST['category'];
$tlength = $_POST['length'];
//$trented = $_POST['rented'];
$query = "INSERT INTO videoCheckout (name, category, length) VALUES (?,?,?)";
$stmt = $db->prepare($query);
$stmt->bind_param('ssi', $tname, $tcategory, $tlength);
if($stmt->execute()){
    echo "Record Saved.";}
$stmt->close();
}
if(isset($_POST['new_submit'])){
    insertData($db);}

$dbi->close();
?>
