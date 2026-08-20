@php
    $phoneE164 = config('company.phone');
    $phoneDisplay = preg_replace('/^\+66/', '0', $phoneE164);
    $phoneHref = 'tel:' . preg_replace('/\D/', '', $phoneDisplay);
    $lineUrl = config('company.social.line') ?? '#contact';
@endphp

<div class="sm:hidden fixed bottom-0 inset-x-0 z-40 grid grid-cols-2 border-t border-white/10">
    <a href="{{ $phoneHref }}" class="bg-ink text-white text-center py-4 text-[15px] font-semibold hover:text-white">โทรเลย</a>
    <a href="{{ $lineUrl }}" class="bg-brand text-white text-center py-4 text-[15px] font-semibold hover:text-white" target="_blank" rel="noopener noreferrer">แชท LINE</a>
</div>
