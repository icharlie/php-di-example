<?php

$action = filter_input(INPUT_GET, 'action');
$top = (int)filter_input(INPUT_GET, 'top');

try {
    $pdo = new PDO(
        'mysql:host=127.0.0.1;dbname=world;port=3306;charset=utf8',
        'homestead',
        'secret'
    );

} catch(PDOException $e) {
    die(json_encode(array('error' => 'y', 'message' => 'Database connection failed')));
}

$results = array();
if ($action == 'getTopPopulationCities') {

    $sql = 'SELECT Name, Population FROM City ORDER BY Population DESC limit :top';
    $statment = $pdo->prepare($sql);
    $statment->bindValue(':top', $top, PDO::PARAM_INT);
    $statment->execute();

    while(($result = $statment->fetch(PDO::FETCH_ASSOC)) !== false) {
        $results[] = $result;
    }
    die(json_encode($results));
}

if ($action == 'getTopPopulationCountries') {
    $sql = 'SELECT Name, Population FROM Country ORDER BY Population DESC limit :top';
    $statment = $pdo->prepare($sql);
    $statment->bindValue(':top', $top, PDO::PARAM_INT);
    $statment->execute();

    while(($result = $statment->fetch(PDO::FETCH_ASSOC)) !== false) {
        $results[] = $result;
    }
    die(json_encode($results));
}
