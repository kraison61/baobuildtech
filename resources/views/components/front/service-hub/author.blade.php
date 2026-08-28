@props(['hub'])

@if ($line = $hub->authorLine())
    <section class="border-t border-line bg-white py-8">
        <x-front.container>
            <p class="text-center text-[14px] text-muted">{{ $line }}</p>
        </x-front.container>
    </section>
@endif
