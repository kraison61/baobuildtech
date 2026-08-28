<?php

namespace App\Contracts;

/**
 * สัญญาเนื้อหาหน้า Hub บริการ — ใช้ร่วมกับ layout service-hub
 */
interface ServiceHubContent
{
    public function slug(): string;

    /**
     * @return array<int, string>
     */
    public function aliases(): array;

    public function breadcrumbLabel(): string;

    public function metaTitle(): string;

    public function metaDescription(): string;

    public function heroEyebrow(): string;

    public function heroTitle(): string;

    public function heroLead(): string;

    public function heroImage(): ?string;

    public function heroImageAlt(): string;

    public function heroSecondaryCtaHref(): string;

    public function heroSecondaryCtaLabel(): string;

    /**
     * @return array<int, string>
     */
    public function enabledSections(): array;

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public function highlights(): array;

    /**
     * @return array<int, array{label: string, href: string}>
     */
    public function jumpLinks(): array;

    public function cardsEyebrow(): string;

    public function cardsTitle(): string;

    public function cardsIntro(): string;

    /**
     * @return array<int, array{no: string, title: string, anchor: string, href: string, body: string, image: string, image_alt: string}>
     */
    public function cards(): array;

    public function pricingEyebrow(): string;

    public function pricingTitle(): string;

    public function pricingIntro(): string;

    /**
     * @return array<int, array{label: string, range: string, unit: string, labor: string}>
     */
    public function priceRows(): array;

    /**
     * @return array<int, string>
     */
    public function priceFactors(): array;

    public function materialsEyebrow(): string;

    public function materialsTitle(): string;

    public function materialsIntro(): string;

    public function materialsImage(): ?string;

    public function materialsImageAlt(): string;

    /**
     * @return array<int, array{label: string, use: string, pros: string, cons: string}>
     */
    public function materialTables(): array;

    public function processEyebrow(): string;

    public function processTitle(): string;

    public function processIntro(): string;

    public function processImage(): ?string;

    public function processImageAlt(): string;

    /**
     * @return array<int, array{no: string, title: string, days: string, body: string}>
     */
    public function processSteps(): array;

    public function guideEyebrow(): string;

    public function guideTitle(): string;

    public function guideIntro(): string;

    /**
     * @return array<int, array{title: string, body: string}>
     */
    public function guideTips(): array;

    public function guideClosing(): string;

    public function portfolioEyebrow(): string;

    public function portfolioTitle(): string;

    public function portfolioIntro(): string;

    public function portfolioImage(): ?string;

    public function portfolioImageAlt(): string;

    public function serviceAreaText(): string;

    public function portfolioWorksHref(): string;

    /**
     * @return array<int, array{q: string, a: string, open?: bool}>
     */
    public function faqs(): array;

    public function ctaTitle(): string;

    public function ctaBody(): string;

    /**
     * @return array<int, string>
     */
    public function ctaPrepareItems(): array;

    public function authorLine(): string;

    public function schemaServiceName(): string;

    public function schemaServiceDescription(): string;
}
