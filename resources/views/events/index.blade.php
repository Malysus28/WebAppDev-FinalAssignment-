<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Upcoming Events</title>
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
  <div class="container py-4">
    <header class="d-flex justify-content-between align-items-center mb-3">
      <div class="fs-4 fw-bold">Event Finder</div>
    </header>

    <h1 class="display-6 mb-3">Upcoming Events</h1>

    <div class="row g-3">
      @forelse ($events as $event)
        @php $available = max(0, $event->capacity - $event->bookings_count); @endphp

        <div class="col-12 col-md-6 col-lg-3">
          <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title mb-1">
                <a class="text-decoration-none text-dark" href="{{ route('events.show', $event) }}">
                  {{ $event->title }}
                </a>
              </h5>

              <div class="text-muted small"><span class="fw-bold">When:</span> {{ $event->starts_at->format('D, d M Y h:i A') }}</div>
              <div class="text-muted small"><span class="fw-bold">Where:</span>  {{ $event->location }}</div>
              <div class="text-muted small"><span class="fw-bold">Organiser:</span> {{ $event->organiser?->name ?? 'Unknown' }}</div>

              <div class="text-muted small mt-2">
                <span class="fw-bold">Capacity:</span> {{ $event->capacity }} · Booked: {{ $event->bookings_count }} · Available: {{ $available }}
              </div>

              {{-- Push the button to the bottom --}}
              <div class="mt-auto pt-2">
                <a class="btn btn-primary btn-sm w-100" href="{{ route('events.show', $event) }}">
                  View details
                </a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="alert alert-info">No upcoming events yet.</div>
        </div>
      @endforelse
    </div>

    <div class="mt-4">
      {{-- Bootstrap-styled paginator --}}
      {{ $events->links('pagination::bootstrap-5') }}
    </div>
  </div>

</body>
</html>
