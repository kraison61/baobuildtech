@props(['faq' => null, 'faqableTypes' => [], 'recordsByType' => []])

<div class="space-y-4">
    <x-admin.morph-select
        type-name="faqable_type"
        id-name="faqable_id"
        :types="$faqableTypes"
        :records-by-type="$recordsByType"
        :selected-type="old('faqable_type', $faq?->faqable_type ?? 'service')"
        :selected-id="old('faqable_id', $faq?->faqable_id ?? '')"
    />

    <div>
        <x-ui.label for="question">คำถาม *</x-ui.label>
        <x-ui.input type="text" name="question" id="question" :value="old('question', $faq?->question)" required maxlength="500" />
    </div>
    <div>
        <x-ui.label for="answer">คำตอบ *</x-ui.label>
        <x-ui.textarea name="answer" id="answer" rows="5" required>{{ old('answer', $faq?->answer) }}</x-ui.textarea>
    </div>

    <div class="mt-2 border-t border-slate-200 pt-4">
        <h3 class="text-sm font-semibold text-slate-700">English</h3>
    </div>
    <div>
        <x-ui.label for="question_en">Question (EN)</x-ui.label>
        <x-ui.input type="text" name="question_en" id="question_en" :value="old('question_en', $faq?->question_en)" maxlength="500" />
    </div>
    <div>
        <x-ui.label for="answer_en">Answer (EN)</x-ui.label>
        <x-ui.textarea name="answer_en" id="answer_en" rows="5">{{ old('answer_en', $faq?->answer_en) }}</x-ui.textarea>
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <x-ui.label for="sort_order">ลำดับ</x-ui.label>
            <x-ui.input type="number" name="sort_order" id="sort_order" :value="old('sort_order', $faq?->sort_order ?? 0)" min="0" />
        </div>
        <div class="flex items-end">
            <x-ui.checkbox name="is_active" value="1" label="เปิดใช้งาน" :checked="old('is_active', $faq?->is_active ?? true)" />
        </div>
    </div>
</div>
