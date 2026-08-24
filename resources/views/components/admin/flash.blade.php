@if (session('success'))
    <x-ui.alert type="success" class="mb-4">{{ session('success') }}</x-ui.alert>
@endif

@if (session('error'))
    <x-ui.alert type="error" class="mb-4">{{ session('error') }}</x-ui.alert>
@endif

@if ($errors->any())
    <x-ui.alert type="error" class="mb-4">
        <ul class="list-inside list-disc space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-ui.alert>
@endif
