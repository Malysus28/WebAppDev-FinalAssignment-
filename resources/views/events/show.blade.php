<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>{{ $event->title }} – Event Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  {{-- Bootstrap 5 CSS --}}
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />

</head>
<body>
@include('navbar')

  <div class="container py-4" style="max-width: 900px;">
    <div class="card shadow-sm">
      <div class="card-body">
        <h1 class="h3 mb-2">{{ $event->title }}</h1>

        <div class="text-muted small mb-1">When: {{ $event->starts_at->format('D, d M Y h:i A') }}</div>
        <div class="text-muted small mb-1">Where: {{ $event->location }}</div>
        <div class="text-muted small mb-3">Organiser: {{ $event->organiser?->name ?? 'Unknown' }}</div>

        <p class="mb-3">{{ $event->description ?? 'No description provided.' }}</p>

        @php
          $available = max(0, $event->capacity - ($event->bookings_count ?? 0));
        @endphp

        <div class="fw-semibold mb-3">
          Capacity: {{ $event->capacity }} · Booked: {{ $event->bookings_count ?? 0 }} · Available: {{ $available }}
        </div>

        <div class="d-flex gap-2 mt-3">
  @can('update', $event)
    <a href="{{ route('events.edit', $event) }}" class="btn btn-outline-primary btn-sm">Edit</a>
  @endcan

  @can('delete', $event)
    <form method="POST" action="{{ route('events.destroy', $event) }}" class="d-inline"
          onsubmit="return confirm('Delete this event?')">
      @csrf @method('DELETE')
      <button class="btn btn-danger btn-sm">Delete</button>
    </form>
  @endcan
</div>


        <div class="d-flex gap-2">
          <button class="btn btn-success" disabled>Book this event</button>
        </div>
      </div>
    </div>
  </div>
      <div class="mb-3">
      <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Back to events</a>
    </div>


</body>
</html>
