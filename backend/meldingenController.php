<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
if(empty($attractie))
{
    $errors[] = "Vul de attractie-naam in.";
}

$capaciteit = $_POST['capaciteit']; 
if(!is_numeric($capaciteit))
{
    $errors[] = "Vul voor capaciteit een geldig getal in.";
}

$melder = $_POST['melder'];
if(empty($melder))
{
    $errors[] = "Naam melder vereist.";
}

$type = $_POST['type'];
if(empty($type))
{
    $errors[] = "Kies een type.";
}

if(isset($errors))
{
    var_dump($errors);
    die();
}


echo $attractie . " / " . $capaciteit . " / " . $melder . " / " . $type;

//1. Verbinding
require_once 'conn.php';

//2. Query

$query = "INSERT INTO meldingen (attractie, capaciteit, melder, type)
VALUES(:attractie, :capaciteit, :melder, :type)";

//3. Prepare

$statement = $conn->prepare($query);

//4. Execute

$statement->execute([
    ":attractie" => $attractie,
    ":capaciteit" => $capaciteit,
    ":melder" => $melder,
    ":type" => $type,
]);

header("Location: ../meldingen/index.php?msg=Melding opgeslagen");

