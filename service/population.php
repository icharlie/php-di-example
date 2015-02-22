<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class Population
 * @author Charlie Chang
 */
class Population
{
    public function getTopPopulationCities($top)
    {
        $results = array();

        try {
            $pdo = new PDO(
                'mysql:host=127.0.0.1;dbname=world;port=3306;charset=utf8',
                'homestead',
                'secret'
            );

        } catch(PDOException $e) {
            die(json_encode(array('error' => 'y', 'message' => 'Database connection failed')));
        }


        $sql = 'SELECT Name, Population FROM City ORDER BY Population DESC limit :top';
        $statment = $pdo->prepare($sql);
        $statment->bindValue(':top', $top, PDO::PARAM_INT);
        $statment->execute();

        while(($result = $statment->fetch(PDO::FETCH_ASSOC)) !== false) {
            $results[] = $result;
        }

        return $results;
    }
}


if (getenv('APP_ENV') != 'testing') {
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

        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();

        $population = $container->make('Population');
        die(json_encode($population->getTopPopulationCities($top)));

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
}

