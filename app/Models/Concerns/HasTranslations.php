<?php

namespace App\Models\Concerns;

trait HasTranslations
{
    /**
     * ฟิลด์ที่รองรับคู่ภาษา (TH = คอลัมน์หลัก, EN = {field}_en)
     *
     * @return list<string>
     */
    abstract public function translatedAttributes(): array;

    public function getAttribute($key): mixed
    {
        if ($this->isTranslatedAttribute($key) && app()->getLocale() === 'en') {
            $enKey = $key.'_en';
            $enValue = $this->attributes[$enKey] ?? null;

            if (filled($enValue)) {
                return $this->transformModelValue($key, $enValue);
            }
        }

        return parent::getAttribute($key);
    }

    /** ค่าภาษาไทยดิบ (ไม่ผ่าน locale fallback) */
    public function getRawTranslation(string $attribute): mixed
    {
        return $this->attributes[$attribute] ?? null;
    }

    /** ค่าภาษาอังกฤษดิบ */
    public function getEnglishTranslation(string $attribute): mixed
    {
        return $this->attributes[$attribute.'_en'] ?? null;
    }

    protected function isTranslatedAttribute(string $key): bool
    {
        return in_array($key, $this->translatedAttributes(), true);
    }
}
