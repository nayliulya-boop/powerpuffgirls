<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LanguageSwitcherTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_switch_locale_to_malay(): void
    {
        $response = $this->get(route('lang.switch', 'ms'));

        $response->assertRedirect();
        $response->assertSessionHas('locale', 'ms');
    }

    public function test_user_can_switch_locale_to_english(): void
    {
        $response = $this->withSession(['locale' => 'ms'])
            ->get(route('lang.switch', 'en'));

        $response->assertRedirect();
        $response->assertSessionHas('locale', 'en');
    }

    public function test_invalid_locale_does_not_change_session(): void
    {
        $response = $this->withSession(['locale' => 'en'])
            ->get(route('lang.switch', 'fr'));

        $response->assertRedirect();
        $response->assertSessionHas('locale', 'en');
    }

    public function test_home_page_renders_malay_translations_when_locale_is_ms(): void
    {
        $response = $this->withSession(['locale' => 'ms'])
            ->get(route('home'));

        $response->assertOk();
        $response->assertSee('Laman Utama');
        $response->assertSee('Tentang Kami');
        $response->assertSee('Pelanggan');
    }

    public function test_customer_dashboard_renders_malay_translations(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['locale' => 'ms'])
            ->get(route('customer.dashboard'));

        $response->assertOk();
        $response->assertSee('Papan Pemuka');
        $response->assertSee('Semua Tempahan');
    }

    public function test_settings_page_can_be_rendered(): void
    {
        $response = $this->get(route('settings'));

        $response->assertOk();
        $response->assertSee('Portal Settings & Language');
        $response->assertSee('English');
        $response->assertSee('Bahasa Melayu');
    }

    public function test_settings_page_supports_return_to_url(): void
    {
        $response = $this->get(route('settings', ['return_to' => route('customer.dashboard')]));

        $response->assertOk();
        $response->assertSee(route('customer.dashboard'));
    }

    public function test_navbar_gear_icon_links_to_settings(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee(route('settings'));
    }
}
