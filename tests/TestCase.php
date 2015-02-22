<?php

/**
 * Class TestCase
 * @author Charlie Chang
 */
class TestCase extends PHPUnit_Framework_TestCase
{
	protected $container;
    /**
     * Setup the test environment
     *
     * @return void
     */
    public function setUp()
    {
        if ( ! $this->container ) {
            $this->container = DI\ContainerBuilder::buildDevContainer();
        }
    }
}
