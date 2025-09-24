<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Bookings</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
</head>
<body class="bg-light">

  {{-- Navbar --}}
  @include('navbar')

  <div class="container my-4" style="max-width: 900px;">
    <h1 class="h4 mb-4">My Bookings</h1>

 {{-- sucess//error --}}
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    {{-- my table card for displaying information --}}
    <div class="card shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped table-hover mb-0 align-middle">
            <thead class="table-light">
              <tr>
                <th>Event Title</th>
                <th style="width: 140px;">Date</th>
                <th style="width: 120px;">Time</th>
                <th style="width: 220px;">Location</th>
              </tr>
            </thead>
            <tbody>
                {{-- passing bookings from my controller to the view and each booking belongs to an event 
                    and they all have a date and check if the start date exists --}}
              @forelse ($bookings as $booking)
                @php
                  $ev = $booking->event;
                  $hasDate = $ev && $ev->starts_at;
                  
                  
                  $dateObj = $hasDate
                    ? ( $ev->starts_at instanceof \Carbon\Carbon ? $ev->starts_at : \Carbon\Carbon::parse($ev->starts_at) )
                    : null;
                @endphp
                <tr>
                  <td>
                    @if ($ev)
                      <a href="{{ route('events.show', $ev) }}" class="text-decoration-none">
                        {{ $ev->title }}
                      </a>
                    @else
                      <span class="text-muted">Event unavailable</span>
                    @endif
                  </td>
                  <td>{{ $dateObj ? $dateObj->format('d M Y') : '—' }}</td>
                  <td>{{ $dateObj ? $dateObj->format('h:i A') : '—' }}</td>
                  <td>{{ $ev?->location ?? '—' }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center text-muted py-4">
                    You haven’t booked any events yet.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="mt-3">
      <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Back to events</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
