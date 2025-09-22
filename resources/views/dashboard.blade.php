<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Organiser Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  {{-- Full custom navbar --}}
  @include('navbar')

  <div class="container my-4">
    <h1 class="h4 mb-4" style="color:#ff7a00;">Organiser Dashboard</h1>
    
    {{-- Your stats and table go here --}}
    {{-- Example table --}}
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>Event Title</th>
            <th>Event Date</th>
            <th class="text-end">Capacity</th>
            <th class="text-end">Bookings</th>
            <th class="text-end">Remaining</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($report as $row)
            <tr>
              <td>{{ $row->event_title ?? 'Untitled event' }}</td>
              <td>
                {{ !empty($row->event_date) ? \Carbon\Carbon::parse($row->event_date)->format('d M Y') : '-' }}
              </td>
              <td class="text-end">{{ $row->total_capacity ?? 0 }}</td>
              <td class="text-end">{{ $row->current_bookings ?? 0 }}</td>
              <td class="text-end">{{ max(0, ($row->total_capacity ?? 0) - ($row->current_bookings ?? 0)) }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center py-4 text-muted">
                No events found. <a href="{{ route('events.create') }}">Create one</a>.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
