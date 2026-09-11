<?php

namespace App\Jobs;

use App\Models\QuoteRequest;
use App\Services\LineMessagingService;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

/**
 * ส่งหลัง HTTP response แล้ว (ไม่ต้องรัน queue:work)
 */
class NotifyLineQuoteRequestJob
{
    use Queueable;

    public function __construct(public QuoteRequest $quoteRequest) {}

    public function handle(LineMessagingService $line): void
    {
        try {
            $line->notifyQuoteRequest($this->quoteRequest);
        } catch (Throwable $e) {
            report($e);
        }
    }
}
