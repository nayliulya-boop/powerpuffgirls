<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test that the home page is rendered properly.
     */
    public function test_home_page_is_rendered(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Azure')
            ->assertSee('Iconic White')
            ->assertSee('Baa Atoll Overwater Villas');
    }
}
