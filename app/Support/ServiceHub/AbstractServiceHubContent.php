<?php

namespace App\Support\ServiceHub;

use App\Contracts\ServiceHubContent;
use App\Models\Service;

abstract class AbstractServiceHubContent implements ServiceHubContent
{
    /**
     * @return array<int, string>
     */
    public function aliases(): array
    {
        return [];
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

        if ($this->highlights() !== []) {
            $sections[] = 'highlights';
        }

        if ($this->jumpLinks() !== []) {
            $sections[] = 'jump';
        }

        if ($this->cards() !== []) {
            $sections[] = 'cards';
        }

        if ($this->priceRows() !== []) {
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
     * @return array<int, array{no: string, title: string, anchor: string, href: string, body: string, image: string, image_alt: string}>
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
     * @return array<int, array{label: string, range: string, unit: string, labor: string}>
     */
    public function priceRows(): array
    {
        return [];
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
