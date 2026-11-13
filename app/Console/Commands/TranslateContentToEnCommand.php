<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TranslateContentToEnCommand extends Command
{
    protected $signature = 'content:translate-en {--force : overwrite existing *_en}';

    protected $description = 'เติมคอลัมน์ *_en จาก database/data/en_translations.json';

    /**
     * ตาราง => [คอลัมน์ *_en ที่อัปเดต]
     *
     * @var array<string, list<string>>
     */
    private array $tables = [
        'service_categories' => ['name_en', 'description_en'],
        'services' => [
            'name_en', 'headline_en', 'description_en', 'excerpt_en',
            'service_type_en', 'meta_title_en', 'meta_description_en', 'content_en',
        ],
        'service_items' => [
            'name_en', 'headline_en', 'description_en', 'excerpt_en',
            'meta_title_en', 'meta_description_en', 'content_en',
        ],
        'posts' => [
            'title_en', 'excerpt_en', 'meta_title_en', 'meta_description_en', 'body_en',
        ],
        'portfolios' => [
            'title_en', 'description_en', 'content_en', 'client_name_en', 'meta_title_en', 'meta_description_en',
        ],
        'locations' => [
            'name_en', 'province_en', 'district_en', 'description_en',
            'meta_title_en', 'meta_description_en',
        ],
        'authors' => ['bio_en', 'job_title_en'],
        'service_prices' => ['label_en', 'price_unit_en', 'note_en'],
        'faqs' => ['question_en', 'answer_en'],
    ];

    public function handle(): int
    {
        $path = database_path('data/en_translations.json');

        if (! is_file($path)) {
            $this->error("ไม่พบไฟล์: {$path}");

            return self::FAILURE;
        }

        /** @var array<string, array<string, array<string, mixed>>> $data */
        $data = json_decode((string) file_get_contents($path), true);

        if (! is_array($data)) {
            $this->error('en_translations.json ไม่ใช่ JSON object ที่ถูกต้อง');

            return self::FAILURE;
        }

        $force = (bool) $this->option('force');
        $totals = [];

        foreach ($this->tables as $table => $columns) {
            $rows = $data[$table] ?? [];
            $updated = 0;
            $skipped = 0;
            $missing = 0;

            foreach ($rows as $id => $fields) {
                if (! is_array($fields)) {
                    continue;
                }

                $id = (int) $id;
                $existing = DB::table($table)->where('id', $id)->first();

                if (! $existing) {
                    $missing++;
                    $this->warn("  [{$table}] id={$id} ไม่พบในฐานข้อมูล — ข้าม");

                    continue;
                }

                $payload = [];

                foreach ($columns as $column) {
                    if (! array_key_exists($column, $fields)) {
                        continue;
                    }

                    $newValue = $fields[$column];
                    $current = $existing->{$column} ?? null;

                    if (! $force && $this->isFilled($current)) {
                        continue;
                    }

                    $payload[$column] = $newValue;
                }

                if ($payload === []) {
                    $skipped++;

                    continue;
                }

                DB::table($table)->where('id', $id)->update($payload);
                $updated++;
            }

            $totals[$table] = compact('updated', 'skipped', 'missing');
            $this->info(sprintf(
                '%s: updated=%d skipped=%d missing=%d',
                $table,
                $updated,
                $skipped,
                $missing,
            ));
        }

        $this->newLine();
        $this->info('สรุปทั้งหมด: updated=' . array_sum(array_column($totals, 'updated')));

        return self::SUCCESS;
    }

    private function isFilled(mixed $value): bool
    {
        if ($value === null) {
            return false;
        }

        if (is_string($value) && trim($value) === '') {
            return false;
        }

        return true;
    }
}
