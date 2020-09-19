<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\openFoodFacts;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
	public function testBasicTest() {
		$response = $this->get('/');
		$response->assertStatus(200);
	}

	public function testAPIPageResponseTest() {
		$response = $this->get('/openFoodFacts/1');
		$response->assertStatus(200);
	}
        public function testAPIPageRedirectTest() {
                $response = $this->get('/openFoodFacts');
                $response->assertStatus(302);
        }
	public function testMessagePageTest1() {
                $response = $this->get('/openFoodFactStored/1');
                $response->assertStatus(200);
        }
        public function testMessagePageTest2() {
                $response = $this->get('/openFoodFactUpdated/1');
                $response->assertStatus(200);
        }
        public function testMessagePageTest3() {
                $response = $this->get('/openFoodFactStorageError/1');
                $response->assertStatus(200);
        }

}
