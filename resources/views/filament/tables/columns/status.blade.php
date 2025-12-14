<x-filament::badge size="sm" color="{{ $getRecord()->status == true ? 'success' : 'danger' }}">
    {{ $getRecord()->status == true ? 'publish' : 'hide' }}
</x-filament::badge>
