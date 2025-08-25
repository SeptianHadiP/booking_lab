{{-- resources/views/components/button/can.blade.php --}}
@if(auth()->check() && auth()->user()->can($permission))
    {{ $slot }}
@endif
