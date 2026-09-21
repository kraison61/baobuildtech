<?php

namespace App\Support\ServiceHub;

use App\Contracts\ServiceHubContent;

/**
 * แปลงเนื้อหา Hub จาก PHP → HTML สำหรับเก็บใน services.content
 */
class HubHtmlExporter
{
    public static function export(ServiceHubContent $hub): string
    {
        $parts = [];

        $lead = trim($hub->heroLead());
        if ($lead !== '') {
            $parts[] = '<p>'.e($lead).'</p>';
        }

        if ($hub->highlights() !== []) {
            $parts[] = '<h2>จุดเด่น</h2>';
            $parts[] = '<ul>';
            foreach ($hub->highlights() as $row) {
                $value = e((string) ($row['value'] ?? ''));
                $label = e((string) ($row['label'] ?? ''));
                $parts[] = "<li><strong>{$value}</strong> — {$label}</li>";
            }
            $parts[] = '</ul>';
        }

        if ($hub->cards() !== []) {
            $parts[] = '<h2>'.e($hub->cardsTitle() ?: 'ประเภทงาน').'</h2>';
            $intro = trim($hub->cardsIntro());
            if ($intro !== '') {
                $parts[] = '<p>'.e($intro).'</p>';
            }
            $parts[] = '<ul>';
            foreach ($hub->cards() as $card) {
                $title = e((string) ($card['title'] ?? ''));
                $body = e((string) ($card['body'] ?? ''));
                $href = (string) ($card['href'] ?? '');
                $path = parse_url($href, PHP_URL_PATH) ?: $href;
                if ($path !== '') {
                    $parts[] = '<li><strong><a href="'.e($path).'">'.$title.'</a></strong> — '.$body.'</li>';
                } else {
                    $parts[] = "<li><strong>{$title}</strong> — {$body}</li>";
                }
            }
            $parts[] = '</ul>';
        }

        $pricingIntro = trim($hub->pricingIntro());
        if ($pricingIntro !== '' || $hub->priceFactors() !== []) {
            $parts[] = '<h2>'.e($hub->pricingTitle() ?: 'ช่วงราคา').'</h2>';
            if ($pricingIntro !== '') {
                $parts[] = '<p>'.e($pricingIntro).'</p>';
            }
            if ($hub->priceFactors() !== []) {
                $parts[] = '<h3>ปัจจัยที่มีผลต่อราคา</h3>';
                $parts[] = '<ul>';
                foreach ($hub->priceFactors() as $factor) {
                    $parts[] = '<li>'.e((string) $factor).'</li>';
                }
                $parts[] = '</ul>';
            }
        }

        if ($hub->materialTables() !== []) {
            $parts[] = '<h2>'.e($hub->materialsTitle() ?: 'เลือกวัสดุ').'</h2>';
            $intro = trim($hub->materialsIntro());
            if ($intro !== '') {
                $parts[] = '<p>'.e($intro).'</p>';
            }
            foreach ($hub->materialTables() as $table) {
                $parts[] = self::renderTable($table);
            }
        }

        if ($hub->processSteps() !== []) {
            $parts[] = '<h2>'.e($hub->processTitle() ?: 'ขั้นตอนการทำงาน').'</h2>';
            $intro = trim($hub->processIntro());
            if ($intro !== '') {
                $parts[] = '<p>'.e($intro).'</p>';
            }
            $parts[] = '<ol>';
            foreach ($hub->processSteps() as $step) {
                $title = e((string) ($step['title'] ?? ''));
                $days = e((string) ($step['days'] ?? ''));
                $body = e((string) ($step['body'] ?? ''));
                $meta = $days !== '' ? " <em>({$days})</em>" : '';
                $parts[] = "<li><strong>{$title}</strong>{$meta} — {$body}</li>";
            }
            $parts[] = '</ol>';
        }

        if ($hub->guideTips() !== []) {
            $parts[] = '<h2>'.e($hub->guideTitle() ?: 'คำแนะนำ').'</h2>';
            $intro = trim($hub->guideIntro());
            if ($intro !== '') {
                $parts[] = '<p>'.e($intro).'</p>';
            }
            foreach ($hub->guideTips() as $tip) {
                $title = e((string) ($tip['title'] ?? ''));
                $body = e((string) ($tip['body'] ?? ''));
                $parts[] = "<h3>{$title}</h3>";
                $parts[] = '<p>'.$body.'</p>';
            }
            $closing = trim($hub->guideClosing());
            if ($closing !== '') {
                $parts[] = '<p>'.e($closing).'</p>';
            }
        }

        $portfolioIntro = trim($hub->portfolioIntro());
        if ($portfolioIntro !== '') {
            $parts[] = '<h2>'.e($hub->portfolioTitle() ?: 'ผลงานและพื้นที่').'</h2>';
            $parts[] = '<p>'.e($portfolioIntro).'</p>';
            $area = trim($hub->serviceAreaText());
            if ($area !== '') {
                $parts[] = '<p>'.e($area).'</p>';
            }
        }

        $author = trim($hub->authorLine());
        if ($author !== '') {
            $parts[] = '<p><em>'.e($author).'</em></p>';
        }

        return implode("\n", $parts);
    }

    /**
     * @param  array{title?: string, columns?: array<int, string>, rows?: array<int, array<int, string>>}  $table
     */
    private static function renderTable(array $table): string
    {
        $html = [];
        $title = trim((string) ($table['title'] ?? ''));
        if ($title !== '') {
            $html[] = '<h3>'.e($title).'</h3>';
        }

        $columns = $table['columns'] ?? [];
        $rows = $table['rows'] ?? [];

        if ($columns === [] || $rows === []) {
            return implode("\n", $html);
        }

        $html[] = '<table>';
        $html[] = '<thead><tr>';
        foreach ($columns as $column) {
            $html[] = '<th>'.e((string) $column).'</th>';
        }
        $html[] = '</tr></thead>';
        $html[] = '<tbody>';
        foreach ($rows as $row) {
            $html[] = '<tr>';
            foreach ($row as $cell) {
                $html[] = '<td>'.e((string) $cell).'</td>';
            }
            $html[] = '</tr>';
        }
        $html[] = '</tbody></table>';

        return implode("\n", $html);
    }
}
