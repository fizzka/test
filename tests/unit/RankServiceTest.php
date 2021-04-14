<?php

namespace tests\unit;

use App\Interfaces\URLLoader;
use App\Services\RankService;
use Exception;
use PHPUnit\Framework\TestCase;

class RankServiceTest extends TestCase
{
    /**
     * @var RankService
     */
    private $rankService;

    /**
     * @var URLLoader
     */
    private $mock;

    public function setUp()
    {
        $this->mock = $this->getMockBuilder(URLLoader::class)->getMock();
        $this->rankService = new RankService($this->mock);
    }

    /**
     * @throws Exception
     */
    public function testGetRankedList()
    {
        $mockData = [
            ["team" => "Axiom", "scores" => 88],
            ["team" => "BnL", "scores" => 65],
            ["team" => "Eva", "scores" => 99],
            ["team" => "WALL-E", "scores" => 99]
        ];
        $mockResult = [
            ["team" => "Eva", "scores" => 99, "rank" => 1],
            ["team" => "WALL-E", "scores" => 99, "rank" => 1],
            ["team" => "Axiom", "scores" => 88, "rank" => 3],
            ["team" => "BnL", "scores" => 65, "rank" => 4]
        ];

        // Add mock result
        $this->mock->method('loadUrl')->willReturn(json_encode($mockData));

        // Perform ranking
        $teams = $this->rankService->getRankedList('http://no-sense-with-mock');

        // Check result
        $this->assertSame($teams, $mockResult);
    }

    /**
     * @throws Exception
     */
    public function testGetRankedListBadData()
    {
        // Add mock result
        $this->mock->method('loadUrl')->willReturn('{ "bad json');

        // Expect error with exception
        $this->expectException(Exception::class);

        // Perform ranking
        $this->rankService->getRankedList('http://no-sense-with-mock');
    }
}
