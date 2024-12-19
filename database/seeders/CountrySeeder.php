<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'Afghanistan'],
            ['name' => 'Albania'],
            ['name' => 'Algeria'],
            ['name' => 'Andorra'],
            ['name' => 'Angola'],
            ['name' => 'Argentina'],
            ['name' => 'Armenia'],
            ['name' => 'Australia'],
            ['name' => 'Austria'],
            ['name' => 'Azerbaijan'],
            ['name' => 'Bahamas'],
            ['name' => 'Bahrain'],
            ['name' => 'Bangladesh'],
            ['name' => 'Barbados'],
            ['name' => 'Belarus'],
            ['name' => 'Belgium'],
            ['name' => 'Belize'],
            ['name' => 'Benin'],
            ['name' => 'Bhutan'],
            ['name' => 'Bolivia'],
            ['name' => 'Brazil'],
            ['name' => 'Bulgaria'],
            ['name' => 'Cambodia'],
            ['name' => 'Cameroon'],
            ['name' => 'Canada'],
            ['name' => 'Chile'],
            ['name' => 'China'],
            ['name' => 'Colombia'],
            ['name' => 'Congo'],
            ['name' => 'Costa Rica'],
            ['name' => 'Croatia'],
            ['name' => 'Cuba'],
            ['name' => 'Cyprus'],
            ['name' => 'Czech Republic'],
            ['name' => 'Denmark'],
            ['name' => 'Ecuador'],
            ['name' => 'Egypt'],
            ['name' => 'Estonia'],
            ['name' => 'Ethiopia'],
            ['name' => 'Fiji'],
            ['name' => 'Finland'],
            ['name' => 'France'],
            ['name' => 'Georgia'],
            ['name' => 'Germany'],
            ['name' => 'Ghana'],
            ['name' => 'Greece'],
            ['name' => 'Grenada'],
            ['name' => 'Guatemala'],
            ['name' => 'Haiti'],
            ['name' => 'Honduras'],
            ['name' => 'Hungary'],
            ['name' => 'Iceland'],
            ['name' => 'India'],
            ['name' => 'Indonesia'],
            ['name' => 'Iran'],
            ['name' => 'Iraq'],
            ['name' => 'Ireland'],
            ['name' => 'Israel'],
            ['name' => 'Italy'],
            ['name' => 'Jamaica'],
            ['name' => 'Japan'],
            ['name' => 'Jordan'],
            ['name' => 'Kazakhstan'],
            ['name' => 'Kenya'],
            ['name' => 'Kuwait'],
            ['name' => 'Latvia'],
            ['name' => 'Lebanon'],
            ['name' => 'Libya'],
            ['name' => 'Lithuania'],
            ['name' => 'Luxembourg'],
            ['name' => 'Madagascar'],
            ['name' => 'Malaysia'],
            ['name' => 'Maldives'],
            ['name' => 'Mali'],
            ['name' => 'Malta'],
            ['name' => 'Mexico'],
            ['name' => 'Monaco'],
            ['name' => 'Mongolia'],
            ['name' => 'Morocco'],
            ['name' => 'Myanmar'],
            ['name' => 'Nepal'],
            ['name' => 'Netherlands'],
            ['name' => 'New Zealand'],
            ['name' => 'Nicaragua'],
            ['name' => 'Nigeria'],
            ['name' => 'North Korea'],
            ['name' => 'Norway'],
            ['name' => 'Oman'],
            ['name' => 'Pakistan'],
            ['name' => 'Panama'],
            ['name' => 'Paraguay'],
            ['name' => 'Peru'],
            ['name' => 'Philippines'],
            ['name' => 'Poland'],
            ['name' => 'Portugal'],
            ['name' => 'Qatar'],
            ['name' => 'Romania'],
            ['name' => 'Russia'],
            ['name' => 'Saudi Arabia'],
            ['name' => 'Senegal'],
            ['name' => 'Serbia'],
            ['name' => 'Singapore'],
            ['name' => 'Slovakia'],
            ['name' => 'Slovenia'],
            ['name' => 'Somalia'],
            ['name' => 'South Africa'],
            ['name' => 'South Korea'],
            ['name' => 'Spain'],
            ['name' => 'Sri Lanka'],
            ['name' => 'Sudan'],
            ['name' => 'Sweden'],
            ['name' => 'Switzerland'],
            ['name' => 'Syria'],
            ['name' => 'Taiwan'],
            ['name' => 'Tanzania'],
            ['name' => 'Thailand'],
            ['name' => 'Tunisia'],
            ['name' => 'Turkey'],
            ['name' => 'Uganda'],
            ['name' => 'Ukraine'],
            ['name' => 'United Arab Emirates'],
            ['name' => 'United Kingdom'],
            ['name' => 'United States'],
            ['name' => 'Uruguay'],
            ['name' => 'Uzbekistan'],
            ['name' => 'Vatican City'],
            ['name' => 'Venezuela'],
            ['name' => 'Vietnam'],
            ['name' => 'Yemen'],
            ['name' => 'Zambia'],
            ['name' => 'Zimbabwe'],
        ];

        foreach ($countries as $country) {
            Country::firstOrCreate($country);
        }
    }
}