<?php

namespace Tests\Feature;

use App\Models\Agenda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AgendaSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_keyword_returns_all_agendas(): void
    {
        $this->createAgendas();

        $response = $this->getJson('/agenda?q=');

        $response->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_whitespace_keyword_returns_all_agendas(): void
    {
        $this->createAgendas();

        $response = $this->getJson('/agenda?q=%20%20');

        $response->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_search_matches_partial_title_case_insensitively(): void
    {
        $this->createAgendas();

        $response = $this->getJson('/agenda?q=rapat');

        $response->assertOk()
            ->assertJsonPath('data.0.title', 'Rapat Tim');
    }

    public function test_search_matches_partial_description(): void
    {
        $this->createAgendas();

        $response = $this->getJson('/agenda?q=laporan');

        $response->assertOk()
            ->assertJsonPath('data.0.title', 'Review Proyek');
    }

    public function test_search_returns_no_agendas_when_keyword_is_not_found(): void
    {
        $this->createAgendas();

        $response = $this->getJson('/agenda?q=tidakada');

        $response->assertOk()
            ->assertJsonCount(0, 'data');
    }

    public function test_kalender_route_returns_page(): void
    {
        $response = $this->get('/kalender');

        $response->assertOk();
    }

    private function createAgendas(): void
    {
        Agenda::create([
            'agenda_name' => 'Rapat Tim',
            'description' => 'Pembahasan agenda mingguan',
            'start_date' => '2026-08-25 09:00:00',
            'end_date' => '2026-08-25 10:00:00',
        ]);

        Agenda::create([
            'agenda_name' => 'Review Proyek',
            'description' => 'Pemeriksaan laporan proyek',
            'start_date' => '2026-08-26 09:00:00',
            'end_date' => null,
        ]);
    }
}