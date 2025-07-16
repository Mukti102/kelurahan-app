<div class="container card p-5">
    <x-header-surat />
    <x-title-surat>
        {{ $title }}
    </x-title-surat>
    {{ $slot }}
    <x-footer-surat />
</div>
