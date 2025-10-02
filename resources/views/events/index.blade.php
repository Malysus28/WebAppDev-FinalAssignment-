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
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body>
    @include('navbar')
  <div class="container py-4">

    <h1 class="display-6 mb-3">Upcoming Events</h1>

    <!-- dropdown categories -->
     @if(isset($allCategories))
<form method="GET" class="mb-3 d-flex align-items-center gap-2">
  <label for="category" class="col-form-label">Filter:</label>
  <select id="category" name="category" class="form-select" style="max-width: 220px;">
    <option value="">All</option>
    @foreach ($allCategories as $cat)
      <option value="{{ $cat }}" {{ (isset($category) && $category === $cat) ? 'selected' : '' }}>
        {{ $cat }}
      </option>
    @endforeach
  </select>
  <button class="btn btn-primary btn-sm">Apply</button>
  @if(request('category'))
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('events.index') }}">Clear</a>
  @endif
</form>
@endif

    <div class="row g-3">
      <!-- for loop that displays the events -->
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

         <!-- categories -->
         @if (!empty($event->categories))
         <div class="mt-2">
            @foreach ($event->categories as $cat)
              <a href="{{ route('events.index', ['category' => $cat]) }}"
               class="badge bg-primary text-decoration-none me-1">{{ $cat }}</a>
                @endforeach
               </div>
               @endif
              

              <!--  view details button   -->
              <div class="mt-auto pt-2">
                <a class="btn btn-outline-primary info btn-sm w-100" href="{{ route('events.show', $event) }}" >
                  View details
                </a>
              </div>

              <!-- book this btn -->
              <form action="{{ route('bookings.store', $event) }}" method="POST" class="mt-2">
                 @csrf
                  <input type="hidden" name="event_id" value="{{ $event->id }}">
                   <button type="submit" class="btn btn-outline-success btn-sm w-100"> Book this event </button>
                  </form>
            </div>
          </div>
        </div>

        <!-- when there is no upcoming events -->
      @empty
        <div class="col-12">
          <div class="alert alert-info">No upcoming events yet.</div>
        </div>
      @endforelse
    </div>

    <!-- paginator display section -->
    <div class="mt-4">
      {{-- Bootstrap-styled paginator --}}
      {{ $events->links('pagination::bootstrap-5') }}
    </div>
  </div>
{{-- EDIT: Bootstrap JS bundle for navbar toggle --}}
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>

</body>
</html>
