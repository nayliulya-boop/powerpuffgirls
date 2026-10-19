<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test navigation synchronization across all public and customer facing modules.
     */
    public function test_all_site_navigation_routes_are_accessible(): void
    {
        $this->get(route('home'))->assertOk();
        $this->get(route('about'))->assertOk();
        $this->get(route('contact'))->assertOk();
        $this->get(route('packages.index'))->assertOk();
        $this->get(route('login'))->assertOk();
        $this->get(route('signup'))->assertOk();
        $this->get(route('customer'))->assertOk();
    }
}
