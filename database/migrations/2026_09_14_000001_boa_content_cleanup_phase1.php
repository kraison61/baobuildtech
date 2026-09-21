<?php

use App\Support\Content\BoaContentCleanupPhase1;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Log;

/**
 * Phase 1: จัดแบรนด์ BOA-Buildtech, ซ่อนเนื้อหาบาง, แยกพื้นที่/ราคาจาก theeraphong.com
 * Idempotent — รันซ้ำได้โดยไม่พัง
 */
return new class extends Migration
{
    public function up(): void
    {
        $report = (new BoaContentCleanupPhase1)->up();

        Log::info('boa_content_cleanup_phase1 completed', $report);

        if ($report['warnings'] !== []) {
            foreach ($report['warnings'] as $warning) {
                Log::warning('boa_content_cleanup_phase1: '.$warning);
            }
        }
    }

    public function down(): void
    {
        (new BoaContentCleanupPhase1)->down();
    }
};
