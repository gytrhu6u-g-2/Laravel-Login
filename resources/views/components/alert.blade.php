@if (session($session))
    <div class="alert alert-{{ $type }}">
        {{ session($session) }}
    </div>
@endif