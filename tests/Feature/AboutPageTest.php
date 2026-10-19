<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    /**
     * Test that the about page renders successfully with 200 OK and contains about-specific sections.
     */
    public function test_about_page_renders_successfully(): void
    {
        $response = $this->get('/about');

        $response->assertOk()
            ->assertSee('About Our Project')
            ->assertSee('No Database Connected')
            ->assertSee('Nayli Ulya')
            ->assertSee('Our Core Values')
            ->assertSee('Frequently Asked Questions');
    }

    /**
     * Test that the about page connects to no database queries.
     */
    public function test_about_page_does_not_execute_database_queries(): void
    {
        DB::enableQueryLog();

        $response = $this->get('/about');

        $response->assertOk();
        $this->assertEmpty(DB::getQueryLog(), 'The about page must not execute any database queries.');
    }

    /**
     * Test navigation synchronization between Home, About, and Login.
     */
    public function test_navigation_routes_are_accessible(): void
    {
        $this->get(route('home'))->assertOk();
        $this->get(route('about'))->assertOk();
        $this->get(route('login'))->assertOk();
    }
}
