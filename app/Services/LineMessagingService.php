<?php

namespace App\Services;

use App\Models\QuoteRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class LineMessagingService
{
    private const BROADCAST_URL = 'https://api.line.me/v2/bot/message/broadcast';

    public function isConfigured(): bool
    {
        return filled($this->accessToken())
            && (bool) config('services.line.enabled', true);
    }

    /**
     * ส่งข้อความแจ้งเตือนคำขอใบเสนอราคาไปยังสมาชิก LINE OA ทุกคน
     */
    public function notifyQuoteRequest(QuoteRequest $quoteRequest): void
    {
        if (! $this->isConfigured()) {
            Log::debug('ข้ามแจ้งเตือน LINE: ยังไม่ได้ตั้งค่า Channel Access Token หรือปิดการใช้งาน');

            return;
        }

        $this->broadcast([
            [
                'type' => 'text',
                'text' => $this->formatQuoteMessage($quoteRequest),
            ],
        ]);
    }

    /**
     * Broadcast ไปยังเพื่อน/สมาชิกของ LINE Official Account ทั้งหมด
     *
     * @param  list<array<string, mixed>>  $messages
     */
    public function broadcast(array $messages): void
    {
        $token = $this->accessToken();

        try {
            Http::withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])
                ->acceptJson()
                ->asJson()
                ->timeout(15)
                ->post(self::BROADCAST_URL, [
                    'messages' => $messages,
                ])
                ->throw();
        } catch (RequestException $e) {
            Log::warning('ส่งแจ้งเตือน LINE OA ไม่สำเร็จ', [
                'status' => $e->response?->status(),
                'body' => $e->response?->body(),
            ]);

            throw $e;
        } catch (Throwable $e) {
            Log::warning('ส่งแจ้งเตือน LINE OA ล้มเหลว', [
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    private function accessToken(): string
    {
        return trim((string) config('services.line.channel_access_token'));
    }

    public function formatQuoteMessage(QuoteRequest $quoteRequest): string
    {
        $adminUrl = route('admin.quote-requests.edit', $quoteRequest);
        $detail = filled($quoteRequest->detail)
            ? trim((string) $quoteRequest->detail)
            : '—';

        $lines = [
            '🔔 คำขอใบเสนอราคาใหม่',
            '',
            'ชื่อ: '.$quoteRequest->name,
            'เบอร์: '.$quoteRequest->phone,
            'งาน: '.$quoteRequest->jobTypeLabel(),
            'พื้นที่: '.$quoteRequest->area,
            'รายละเอียด: '.$detail,
            '',
            'เวลา: '.$quoteRequest->created_at?->timezone(config('app.timezone'))->format('d/m/Y H:i'),
            'เปิดใน Admin: '.$adminUrl,
        ];

        return implode("\n", $lines);
    }
}
