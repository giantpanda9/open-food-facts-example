<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\openFoodFacts;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
	public function testBasicTest() {
		$this->assertTrue(true);
	}
	public function testExistsTest() {
                $openFoodFacts = new openFoodFacts;
                $randomPage = rand(1,1000);
                $randomItem = rand(0,16);
                $response = $openFoodFacts->getResponse($randomPage,"");
                $this->assertArrayHasKey('ID', $response["products"][$randomItem]);
        }
        public function testContentTest() {
                $openFoodFacts = new openFoodFacts;
                $response = $openFoodFacts->getResponse(1,"");
                $this->assertCount(17,$response["products"],"Unexpected item count on first page. Check API response.");
        }
}
