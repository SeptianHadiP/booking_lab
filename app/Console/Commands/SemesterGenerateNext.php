<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Semester;
use Carbon\Carbon;

class SemesterGenerateNext extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:semester-generate-next';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $last = Semester::orderBy('id', 'desc')->first();

        if (!$last) {
            $this->warn('Belum ada data semester. Jalankan seeder awal dulu.');
            return self::SUCCESS;
        }

        if ($now->lte(Carbon::parse($last->end_date))) {
            $this->info("Belum waktunya. Semester terakhir ($last->id) masih berjalan.");
            return self::SUCCESS;
        }

        $year = (int) substr($last->id, 0, 4);
        $code = (int) substr($last->id, -1); // 1=ganjil, 2=genap

        if ($code === 1) {
            // Next = GENAP tahun ajar yang sama
            $nextId        = $year . '2';
            $academicYear  = $year . '/' . ($year + 1);
            $term          = 'genap';
            $startDate     = Carbon::create($year + 1, 2, 1);
            $endDate       = Carbon::create($year + 1, 7, 31);
        } else {
            // Next = GANJIL tahun ajar berikutnya
            $nextYear      = $year + 1;
            $nextId        = $nextYear . '1';
            $academicYear  = $nextYear . '/' . ($nextYear + 1);
            $term          = 'ganjil';
            $startDate     = Carbon::create($nextYear, 8, 1);
            $endDate       = Carbon::create($nextYear + 1, 1, 31);
        }

        // Hindari duplikasi
        if (Semester::where('id', $nextId)->exists()) {
            $this->info("Semester $nextId sudah ada.");
            return self::SUCCESS;
        }

        Semester::create([
            'id'            => $nextId,
            'academic_year' => $academicYear,
            'term'          => $term,
            'start_date'    => $startDate,
            'end_date'      => $endDate,
        ]);

        $this->info("Semester baru $nextId ($term $academicYear) berhasil dibuat.");
        return self::SUCCESS;
    }
}
