<form method="POST" action="{{ $action }}" class="inline" onsubmit="return confirm('{{ $confirm ?? 'ยืนยันการลบ?' }}')">
    @csrf
    @method('DELETE')
    <x-ui.button type="submit" variant="danger" class="!px-3 !py-1.5 text-xs">
        {{ $slot->isEmpty() ? 'ลบ' : $slot }}
    </x-ui.button>
</form>
