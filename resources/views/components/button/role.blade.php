{{-- resources/views/components/button/can.blade.php --}}
@if(auth()->check() && auth()->user()->can($role))
    {{ $slot }}
@endif
