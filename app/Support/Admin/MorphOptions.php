<?php

namespace App\Support\Admin;

use App\Models\Author;
use App\Models\Location;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;

class MorphOptions
{
    /** @return array<string, string> */
    public static function faqableTypes(): array
    {
        return [
            'service_category' => 'หมวดหมู่บริการ',
            'service' => 'บริการ',
            'service_item' => 'รายการบริการ',
            'post' => 'บทความ',
            'location' => 'พื้นที่ให้บริการ',
            'portfolio' => 'ผลงาน',
        ];
    }

    /** @return array<string, string> */
    public static function priceableTypes(): array
    {
        return [
            'service' => 'บริการ',
            'service_item' => 'รายการบริการ',
        ];
    }

    /** @return array<string, string> */
    public static function priceTypes(): array
    {
        return [
            'unit' => 'ต่อหน่วย',
            'material' => 'ตามวัสดุ',
            'package' => 'แพ็กเกจ',
            'volume' => 'ปริมาณงาน',
        ];
    }

    /**
     * @return list<array{id: int, label: string}>
     */
    public static function faqableRecords(string $type): array
    {
        return match ($type) {
            'service_category' => ServiceCategory::query()->orderBy('sort_order')->get()
                ->map(fn ($m) => ['id' => $m->id, 'label' => $m->name])->all(),
            'service' => Service::query()->with('category')->orderBy('sort_order')->get()
                ->map(fn ($m) => ['id' => $m->id, 'label' => ($m->category?->name ?? '').' › '.$m->name])->all(),
            'service_item' => ServiceItem::query()->with('service')->orderBy('sort_order')->get()
                ->map(fn ($m) => ['id' => $m->id, 'label' => ($m->service?->name ?? '').' › '.$m->name])->all(),
            'post' => Post::query()->orderByDesc('published_at')->get()
                ->map(fn ($m) => ['id' => $m->id, 'label' => $m->title])->all(),
            'location' => Location::query()->orderBy('name')->get()
                ->map(fn ($m) => ['id' => $m->id, 'label' => $m->name])->all(),
            'portfolio' => Portfolio::query()->orderByDesc('completed_at')->get()
                ->map(fn ($m) => ['id' => $m->id, 'label' => $m->title])->all(),
            default => [],
        };
    }

    /**
     * @return list<array{id: int, label: string}>
     */
    public static function priceableRecords(string $type): array
    {
        return match ($type) {
            'service' => Service::query()->with('category')->orderBy('sort_order')->get()
                ->map(fn ($m) => ['id' => $m->id, 'label' => ($m->category?->name ?? '').' › '.$m->name])->all(),
            'service_item' => ServiceItem::query()->with('service')->orderBy('sort_order')->get()
                ->map(fn ($m) => ['id' => $m->id, 'label' => ($m->service?->name ?? '').' › '.$m->name])->all(),
            default => [],
        };
    }
}
