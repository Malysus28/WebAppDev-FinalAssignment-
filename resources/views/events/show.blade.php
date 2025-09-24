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

{{-- card for events details --}}
  <div class="container py-4" style="max-width: 900px;">
    <div class="card shadow-sm">
      <div class="card-body">
        <h1 class="h3 mb-2">{{ $event->title }}</h1>

        {{-- info about events --}}
        <div class="text-muted small mb-1">When: {{ $event->starts_at->format('D, d M Y h:i A') }}</div>
        <div class="text-muted small mb-1">Where: {{ $event->location }}</div>
        <div class="text-muted small mb-3">Organiser: {{ $event->organiser?->name ?? 'Unknown' }}</div>

        <p class="mb-3">{{ $event->description ?? 'No description provided.' }}</p>

        {{-- CAPACITY/ TOTAL/BOOKED/AVAILABLE --}}
        @php
          $available = max(0, $event->capacity - ($event->bookings_count ?? 0));
        @endphp
        <div class="fw-semibold mb-3">
          Capacity: {{ $event->capacity }}
           · Booked: {{ $event->bookings_count ?? 0 }} 
           · Available: {{ $available }}
        </div>

        {{-- ORGANISER ONLY BUTTON to edit and delete --}}
        <div class="d-flex gap-2 mt-3">
  <div class="d-flex gap-2 mt-3">

          @auth

          {{--  only show is the logged in user is this/current event's organiser --}}

            @if(auth()->id() === $event->organiser_id) {{-- Only show if logged-in user is the event organiser --}}
              <a href="{{ route('organiser.events.edit', $event) }}" class="btn btn-outline-primary btn-sm">
                Edit
              </a>

              {{-- DELETE only if there are no bookings --}}
              @if(($event->bookings_count ?? $event->bookings->count() ?? 0) == 0)
                <form method="POST" action="{{ route('organiser.events.destroy', $event) }}" class="d-inline"
                      onsubmit="return confirm('Delete this event?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm">Delete</button>
                </form>
              @else
                <button class="btn btn-danger btn-sm" disabled title="This event has bookings and cannot be deleted.">
                  Delete
                </button>
              @endif
            @endif
          @endauth
        </div>
</div>


{{-- validation messages --}}
@if ($errors->any())
  <div class="alert alert-danger mt-3">{{ $errors->first() }}</div>
@endif
@if (session('error'))
  <div class="alert alert-danger mt-3">{{ session('error') }}</div>
@endif
@if (session('success'))
  <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif


{{-- this is the booking secttion --}}
@auth
  @php
    $bookedCount = $event->bookings_count ?? $event->bookings()->count();
    $cap = (int)($event->capacity ?? 0);
    $isFull = $bookedCount >= $cap;

    //checking if the current user has booking that event 
    $alreadyBooked = $event->bookings()->where('user_id', auth()->id())->exists();
  @endphp


  @if (!$isFull && !$alreadyBooked)
   {{-- The POST form that actually creates a booking --}}
    <form action="{{ route('bookings.store', $event) }}" method="POST" class="mt-3">
      @csrf
      <input type="hidden" name="event_id" value="{{ $event->id }}">
      <button type="submit" class="btn btn-success">Book this event</button>
    </form>

    
  @elseif ($alreadyBooked)
    <div class="mt-3 text-success">You have already booked this event.</div>
  @else
    <div class="mt-3 text-danger">Sorry, this event is full.</div>
  @endif
@else
  <div class="mt-3">
    <a class="btn btn-outline-secondary" href="{{ route('login') }}">Log in to book</a>
  </div>
@endauth
      </div>
      <br />
    </div>
     <br />
          <div class="mb-3">
      <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Back to events</a>
    </div>

  </div>


</body>
</html>
