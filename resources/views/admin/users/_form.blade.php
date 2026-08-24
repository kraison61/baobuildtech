@props(['user' => null])

<div class="grid gap-4 sm:grid-cols-2">
    <div>
        <x-ui.label for="name">ชื่อ *</x-ui.label>
        <x-ui.input type="text" name="name" id="name" :value="old('name', $user?->name)" required />
    </div>
    <div>
        <x-ui.label for="email">อีเมล *</x-ui.label>
        <x-ui.input type="email" name="email" id="email" :value="old('email', $user?->email)" required />
    </div>
    <div>
        <x-ui.label for="password">รหัสผ่าน {{ $user ? '(ว่าง = ไม่เปลี่ยน)' : '*' }}</x-ui.label>
        <x-ui.input type="password" name="password" id="password" :required="! $user" autocomplete="new-password" />
    </div>
    <div>
        <x-ui.label for="password_confirmation">ยืนยันรหัสผ่าน</x-ui.label>
        <x-ui.input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" />
    </div>
</div>
