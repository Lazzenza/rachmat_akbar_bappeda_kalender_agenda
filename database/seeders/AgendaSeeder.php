<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agendas = [
            [
                'agenda_name' => 'Rapat Koordinasi Bulanan',
                'description' => 'Pembahasan target kerja dan evaluasi program bulanan.',
                'start_date' => now()->addDays(1)->setTime(9, 0),
                'end_date' => now()->addDays(1)->setTime(11, 0),
            ],
            [
                'agenda_name' => 'Pelatihan Pengguna Baru',
                'description' => 'Sosialisasi penggunaan aplikasi dan alur kerja harian.',
                'start_date' => now()->addDays(2)->setTime(13, 30),
                'end_date' => now()->addDays(2)->setTime(15, 30),
            ],
            [
                'agenda_name' => 'Review Proyek',
                'description' => 'Evaluasi progres tugas dan penentuan prioritas berikutnya.',
                'start_date' => now()->addDays(4)->setTime(10, 0),
                'end_date' => now()->addDays(4)->setTime(12, 0),
            ],

            [
                'agenda_name' => 'Rapat Tim Proyek',
                'description' => 'Diskusi masalah dan solusi terkait proyek yang sedang berjalan.',
                'start_date' => now()->addDays(5)->setTime(14, 0),
                'end_date' => now()->addDays(5)->setTime(16, 0),
            ],
            [
                'agenda_name' => 'Presentasi Hasil Penelitian',
                'description' => 'Pemaparan hasil penelitian dan diskusi temuan terbaru.',
                'start_date' => now()->addDays(7)->setTime(9, 30),
                'end_date' => now()->addDays(7)->setTime(11, 30),
            ],

    
        ];

        foreach ($agendas as $agenda) {
            Agenda::query()->firstOrCreate(
                ['agenda_name' => $agenda['agenda_name'], 'start_date' => $agenda['start_date']],
                $agenda
            );
        }
    }
}
