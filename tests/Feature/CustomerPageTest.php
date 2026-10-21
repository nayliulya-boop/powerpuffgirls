<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CustomerPageTest extends TestCase
{
    /**
     * Test that the customer page renders successfully with 200 OK and contains expected sections.
     */
    public function test_customer_page_renders_successfully(): void
    {
        $response = $this->get('/customer');

        $response->assertOk()
            ->assertSee('Customer Hub')
            ->assertSee('VIP Traveler Portal')
            ->assertSee('Silver Explorer')
            ->assertSee('Gold Voyager')
            ->assertSee('Platinum Sovereign')
            ->assertSee('Soalan Lazim Pelanggan AzureVoyage');
    }

    /**
     * Test that the customer page connects to zero database queries.
     */
    public function test_customer_page_does_not_execute_database_queries(): void
    {
        DB::enableQueryLog();

        $response = $this->get('/customer');

        $response->assertOk();
        $this->assertEmpty(DB::getQueryLog(), 'The customer page must not execute any database queries.');
    }

    /**
     * Test navigation synchronization between Home, About, Customer, and Login.
     */
    public function test_all_site_navigation_routes_are_accessible(): void
    {
        $this->get(route('home'))->assertOk();
        $this->get(route('about'))->assertOk();
        $this->get(route('customer'))->assertOk();
        $this->get(route('login'))->assertOk();
    }
}
