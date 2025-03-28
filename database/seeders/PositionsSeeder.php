<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PositionsSeeder extends Seeder
{
    private function fetchPositions(): array
    {
        return Http::acceptJson()
            ->get(config('users.positionsUrl'))
            ->collect('positions')
            ->toArray() ?? [];
    }

    public function run(): void
    {
        DB::table('positions')->insert(
            $this->fetchPositions()
        );
    }
}
