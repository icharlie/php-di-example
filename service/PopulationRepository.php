<?php

/**
 * Class PopulationRepository
 * @author Charlie Chang
 */
class PopulationRepository
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=127.0.0.1;dbname=world;port=3306;charset=utf8',
                'homestead',
                'secret'
            );

        } catch(PDOException $e) {
            die(json_encode(array('error' => 'y', 'message' => 'Database connection failed')));
        }
    }

    public function queryTopPopulationCities($top)
    {
        $results = array();

        $sql = 'SELECT Name, Population FROM City ORDER BY Population DESC limit :top';
        $statment = $this->pdo->prepare($sql);
        $statment->bindValue(':top', $top, PDO::PARAM_INT);
        $statment->execute();

        while(($result = $statment->fetch(PDO::FETCH_ASSOC)) !== false) {
            $results[] = $result;
        }

        return $results;
    }

    public function queryTopPopulationCountries($top)
    {
        $results = array();

        $sql = 'SELECT Name, Population FROM Country ORDER BY Population DESC limit :top';
        $statment = $this->pdo->prepare($sql);
        $statment->bindValue(':top', $top, PDO::PARAM_INT);
        $statment->execute();

        while(($result = $statment->fetch(PDO::FETCH_ASSOC)) !== false) {
            $results[] = $result;
        }
    }
}
