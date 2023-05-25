<?php

use PHPUnit\Framework\TestCase;
class RunTest extends TestCase
{
    public function testRunPathfind()
    {
        require 'run.php';

        $graph1 = array(
            array('.', 'P', '.', '.', '.'),
            array('.', '#', '#', '#', '.'),
            array('.', '.', '.', '.', '.'),
            array('.', '.', 'Q', '.', '.'),
            array('.', '.', '.', '.', '.'),
        );

        $graph2 = array(
            array('.', 'P', '.', '.', '.', '.', '.'),
            array('.', '#', '#', '#', '.', '.', '.'),
            array('.', '.', '.', '.', '.', '.', '.'),
            array('.', '.', '.', '.', '.', '.', '.'),
            array('.', '#', '.', '.', '.', '#', '.'),
            array('.', '.', '.', '.', '.', '.', '.'),
            array('.', '.', '.', '#', '.', '.', '.'),
            array('.', '#', '.', '#', '.', '.', '.'),
            array('.', '#', 'Q', '#', '.', '.', '.'),
        );

        $graph3 = array(
            array('.', 'P', '.', '.', '.'),
            array('.', '#', '#', '#', '.'),
            array('.', '.', '.', '.', '.'),
            array('.', '.', '.', '.', '.'),
            array('.', '.', '.', '.', 'Q'),
        );

        $this->assertEquals(6, pathfind($graph1));
        $this->assertEquals(11, pathfind($graph2));
        $this->assertEquals(7, pathfind($graph3));
    }
}