@if(auth()->user())
    <img src="{{ auth()->user()->foto_url }}" alt="Profile">
@else
    <!-- Tampilkan gambar default -->
    <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile">
@endif 