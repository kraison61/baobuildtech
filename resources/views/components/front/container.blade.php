@props([
    'as' => 'div',
])

{{-- ระยะซ้าย–ขวาเดียวทั้งหน้า: max 1160px + gutter px-5 (อย่าใส่ px-5 ที่ section อีกชั้น) --}}
<{{ $as }} {{ $attributes->class('mx-auto max-w-[1160px] px-5') }}>
    {{ $slot }}
</{{ $as }}>
