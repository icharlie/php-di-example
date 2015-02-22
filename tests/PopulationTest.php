<?php

use Mockery as m;

/**
 * Class PopulationTest
 * @author Charlie Chang
 */
class PopulationTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
		$this->populationRepo = m::mock('PopulationRepository');
        $this->container->set('PopulationRepository', $this->populationRepo);
        $this->population = $this->container->make('Population');
    }

    public function tearDown()
    {
        m::close();
    }

    public function testGetTopPopulationCities()
    {
		$this->populationRepo->shouldReceive('queryTopPopulationCities')
			->once()->andReturn([['Name' => 'A', 'Population' => 100]]);

        $result = $this->population->getTopPopulationCities(10);
        $this->assertEquals([['Name' => 'A', 'Population' => 100]], $result);
    }
}
