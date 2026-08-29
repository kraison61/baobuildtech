<?php

namespace App\Support\ServiceHub;

use App\Contracts\ServiceHubContent;
use App\Models\Service;
use App\Models\ServicePrice;
use Illuminate\Support\Collection;

abstract class AbstractServiceHubContent implements ServiceHubContent
{
    /** @var Collection<int, ServicePrice>|null */
    private ?Collection $visiblePricesCache = null;

    private ?Service $serviceCache = null;

    private ?bool $serviceResolved = null;

    /**
     * @return array<int, string>
     */
    public function aliases(): array
    {
        return [];
    }

    public function categorySlug(): string
    {
        $categorySlug = Service::query()
            ->where('slug', $this->slug())
            ->where('is_published', true)
            ->whereHas('category', static fn ($q) => $q->where('is_active', true))
            ->with('category')
            ->first()
            ?->category
            ?->slug;

        if ($categorySlug === null || $categorySlug === '') {
            throw new \RuntimeException("Hub [{$this->slug()}] has no published service with active category.");
        }

        return $categorySlug;
    }

    public function url(): string
    {
        return route('services.show', [$this->categorySlug(), $this->slug()]);
    }

    public function heroImage(): ?string
    {
        $fromDb = Service::query()
            ->where('slug', $this->slug())
            ->where('is_published', true)
            ->value('cover_image');

        return filled($fromDb) ? (string) $fromDb : null;
    }

    public function heroSecondaryCtaHref(): string
    {
        return '#services';
    }

    public function heroSecondaryCtaLabel(): string
    {
        return 'ดูประเภทงาน';
    }

    /**
     * @return array<int, string>
     */
    public function enabledSections(): array
    {
        $sections = ['hero'];

        if ($this->visiblePrices()->isNotEmpty()) {
            $sections[] = 'price-summary';
        }

        if ($this->highlights() !== []) {
            $sections[] = 'highlights';
        }

        if ($this->jumpLinks() !== []) {
            $sections[] = 'jump';
        }

        if ($this->cards() !== []) {
            $sections[] = 'cards';
        }

        if ($this->visiblePrices()->isNotEmpty()) {
            $sections[] = 'pricing';
        }

        if ($this->materialTables() !== []) {
            $sections[] = 'materials';
        }

        if ($this->processSteps() !== []) {
            $sections[] = 'process';
        }

        if ($this->guideTips() !== []) {
            $sections[] = 'guide';
        }

        if ($this->portfolioIntro() !== '') {
            $sections[] = 'portfolio';
        }

        if ($this->faqs() !== []) {
            $sections[] = 'faq';
        }

        $sections[] = 'cta';

        if ($this->authorLine() !== '') {
            $sections[] = 'author';
        }

        return $sections;
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public function highlights(): array
    {
        return [];
    }

    /**
     * @return array<int, array{label: string, href: string}>
     */
    public function jumpLinks(): array
    {
        return [];
    }

    public function cardsEyebrow(): string
    {
        return 'ประเภทงาน';
    }

    public function cardsTitle(): string
    {
        return 'งานที่เรารับทำมีอะไรบ้าง';
    }

    public function cardsIntro(): string
    {
        return '';
    }

    /**
     * @return array<int, array{no: string, title: string, href: string, body: string, image: string, image_alt: string}>
     */
    public function cards(): array
    {
        return [];
    }

    public function pricingEyebrow(): string
    {
        return 'ช่วงราคา';
    }

    public function pricingTitle(): string
    {
        return 'ราคาคิดยังไง เริ่มต้นเท่าไหร่';
    }

    public function pricingIntro(): string
    {
        return '';
    }

    /**
     * @return Collection<int, ServicePrice>
     */
    public function visiblePrices(): Collection
    {
        if ($this->visiblePricesCache !== null) {
            return $this->visiblePricesCache;
        }

        $service = $this->resolveService();

        if ($service === null) {
            return $this->visiblePricesCache = collect();
        }

        $prices = $service->prices;

        foreach ($service->items as $item) {
            $prices = $prices->concat($item->prices);
        }

        return $this->visiblePricesCache = $prices->unique('id')->values();
    }

    /**
     * @return Collection<int, \App\Models\ServiceItem>
     */
    public function publishedItems(): Collection
    {
        return $this->resolveService()?->items ?? collect();
    }

    private function resolveService(): ?Service
    {
        if ($this->serviceResolved) {
            return $this->serviceCache;
        }

        $this->serviceResolved = true;

        $this->serviceCache = Service::query()
            ->where('slug', $this->slug())
            ->where('is_published', true)
            ->whereHas('category', static fn ($q) => $q->where('is_active', true))
            ->with([
                'prices' => static fn ($q) => $q
                    ->where('is_visible', true)
                    ->orderBy('sort_order'),
                'items' => static fn ($q) => $q
                    ->where('is_published', true)
                    ->orderBy('sort_order')
                    ->with([
                        'prices' => static fn ($q) => $q
                            ->where('is_visible', true)
                            ->orderBy('sort_order'),
                    ]),
            ])
            ->first();

        return $this->serviceCache;
    }

    /**
     * @return array<int, string>
     */
    public function priceFactors(): array
    {
        return [];
    }

    public function materialsEyebrow(): string
    {
        return 'เลือกวัสดุ';
    }

    public function materialsTitle(): string
    {
        return 'เปรียบเทียบวัสดุและสเปก';
    }

    public function materialsIntro(): string
    {
        return '';
    }

    public function materialsImage(): ?string
    {
        return null;
    }

    public function materialsImageAlt(): string
    {
        return '';
    }

    /**
     * @return array<int, array{title: string, columns: array<int, string>, rows: array<int, array<int, string>>}>
     */
    public function materialTables(): array
    {
        return [];
    }

    public function processEyebrow(): string
    {
        return 'ขั้นตอนการทำงาน';
    }

    public function processTitle(): string
    {
        return 'ตั้งแต่สำรวจหน้างานถึงส่งมอบ';
    }

    public function processIntro(): string
    {
        return '';
    }

    public function processImage(): ?string
    {
        return null;
    }

    public function processImageAlt(): string
    {
        return '';
    }

    /**
     * @return array<int, array{no: string, title: string, days: string, body: string}>
     */
    public function processSteps(): array
    {
        return [];
    }

    public function guideEyebrow(): string
    {
        return 'คำแนะนำ';
    }

    public function guideTitle(): string
    {
        return 'เลือกผู้รับเหมาอย่างไร';
    }

    public function guideIntro(): string
    {
        return '';
    }

    /**
     * @return array<int, array{title: string, body: string}>
     */
    public function guideTips(): array
    {
        return [];
    }

    public function guideClosing(): string
    {
        return '';
    }

    public function portfolioEyebrow(): string
    {
        return 'ผลงานและพื้นที่';
    }

    public function portfolioTitle(): string
    {
        return 'ผลงานและพื้นที่ให้บริการ';
    }

    public function portfolioIntro(): string
    {
        return '';
    }

    public function portfolioImage(): ?string
    {
        return null;
    }

    public function portfolioImageAlt(): string
    {
        return '';
    }

    public function serviceAreaText(): string
    {
        return 'พื้นที่ให้บริการ: กรุงเทพมหานคร นนทบุรี ปทุมธานี สมุทรปราการ สมุทรสาคร และนครปฐม (สำรวจหน้างานฟรี) · ต่างจังหวัดรับงานได้ทั่วประเทศ';
    }

    public function portfolioWorksHref(): string
    {
        return route('works');
    }

    /**
     * @return array<int, array{q: string, a: string, open?: bool}>
     */
    public function faqs(): array
    {
        return [];
    }

    public function ctaTitle(): string
    {
        return 'ขอใบเสนอราคา';
    }

    public function ctaBody(): string
    {
        return 'ตอบกลับภายใน 1 วันทำการ — เลือกช่องทางด้านล่าง';
    }

    /**
     * @return array<int, string>
     */
    public function ctaPrepareItems(): array
    {
        return [];
    }

    public function authorLine(): string
    {
        return '';
    }

    public function schemaServiceName(): string
    {
        return $this->breadcrumbLabel();
    }

    public function schemaServiceDescription(): string
    {
        return $this->heroLead();
    }
}
