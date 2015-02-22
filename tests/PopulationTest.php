<?php

/**
 * Class PopulationTest
 * @author Charlie Chang
 */
class PopulationTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->population = $this->container->make('Population');
	}

    public function testGetTopPopulationCities()
    {
		$result = $this->population->getTopPopulationCities(10);
		$this->assertEquals([['Name' => 'A', 'Population' => 100]], $result);
    }
}
