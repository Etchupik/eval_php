<!DOCTYPE html>
<html>
<body>
 <h1>Liste des Chiens</h1>
 <?php
$pdo = new PDO('mysql:host=localhost; dbname=mydb', 'root', '');
$utils=$pdo->query('SELECT * FROM mydb.chien');
$a=$utils->fetchAll(PDO::FETCH_OBJ);

function add($Nom, $Race) {
    global $pdo;
    $add = $pdo->prepare("INSERT INTO mydb.chien(`Nom`,`Race`) VALUE(?,?)");
    $add->bindParam(1,$Nom);
    $add->bindParam(2,$Race);
    $add->execute();
    $add;
}

if(isset($_REQUEST['Nom']) && isset($_REQUEST['Race'])) {
    $Nom = $_REQUEST['Nom'];
    $Race = $_REQUEST['Race'];
    add($Nom, $Race);
    echo "<meta http-equiv='refresh' content='0'>";
}
?>

<ul>
<?php 
    foreach ($a as $key => $value) { ?>
<li>
    <p> <?= $value->Nom ?>
        <?= $value->Race ?>
    <p> 
 </li>
    <?php } ?>
</ul>

<form method="post">
<label> Nom : 
    <input type="text" name="Nom">
    </label>
    <label> Race : 
    <input type="text" name="Race">
    </label>
    <input type="submit" value="créer un chien">
</form>


</body>
</html>