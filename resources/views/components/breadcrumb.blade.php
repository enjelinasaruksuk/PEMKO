@props(['items' => [], 'title' => ''])

<div class="mb-3">
    <small class="text-muted">
        @foreach ($items as $index => $item)
            {{ $item }}
            @if (!$loop->last) / @endif
        @endforeach
    </small>
    <h4 class="fw-bold mb-0">{{ $title }}</h4>
</div>