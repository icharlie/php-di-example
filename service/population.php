<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class Population
 * @author Charlie Chang
 */
class Population
{
    public function __construct(PopulationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getTopPopulationCities($top)
    {
        return $this->repository->queryTopPopulationCities($top);
    }

    public function getTopPopulationCountries($top)
    {

        return $this->repository->queryTopPopulationCountries($top);
    }
}


if (getenv('APP_ENV') != 'testing') {
    $action = filter_input(INPUT_GET, 'action');
    $top = (int)filter_input(INPUT_GET, 'top');
    $builder = new \DI\ContainerBuilder();
    $container = $builder->build();

    $population = $container->make('Population');

    if ($action == 'getTopPopulationCities') {
        die(json_encode($population->getTopPopulationCities($top)));
    }

    if ($action == 'getTopPopulationCountries') {
        die(json_encode($population->getTopPopulationCountries($top)));
    }
}

