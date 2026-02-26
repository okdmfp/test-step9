<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $company1 = Company::create(['company_name' => 'TNG']);
        $company2 = Company::create(['company_name' => 'ABC Corp']);

        User::create([
            'name' => 'Cy',
            'name_kanji' => '山田太郎',
            'name_kana' => 'ヤマダタロウ',
            'email' => 'cy.com',
            'password' => Hash::make('password'),
            'company_id' => $company1->id,
        ]);

        User::create([
            'name' => 'test',
            'name_kanji' => '鈴木花子',
            'name_kana' => 'スズキハナコ',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'company_id' => $company2->id,
        ]);
    }
}
