<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Country;
use Database\Seeders\CountrySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountrySeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_country_seeder_works()
    {
        $this->seed(CountrySeeder::class);

        // Check if countries were inserted
        $this->assertDatabaseHas('countries', [
            'name' => 'United States'
        ]);

        $this->assertDatabaseHas('countries', [
            'name' => 'United Kingdom'
        ]);

        // Check total count
        $this->assertTrue(Country::count() > 100);
    }
}
