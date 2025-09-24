<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Manage Events</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  @include('navbar')

  <main class="container py-4">
    <h1 class="mb-4">Manage Events</h1>

    
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div> @endif
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
      </div>
    @endif

   {{-- make a new event in ev manager --}}
    <div class="card mb-4">
      <div class="card-header fw-semibold">Create New Event</div>
      <div class="card-body">
        <form method="POST" action="{{ route('organiser.events.store') }}" class="row g-3">
          @csrf

          <div class="col-12">
            <label class="form-label">Title *</label>
            <input type="text" name="title" value="{{ old('title') }}" maxlength="100" required
                   class="form-control @error('title') is-invalid @enderror">
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-4">
            <label class="form-label">Date &amp; Time *</label>
            <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}" required
                   class="form-control @error('starts_at') is-invalid @enderror">
            @error('starts_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-4">
            <label class="form-label">Location *</label>
            <input type="text" name="location" value="{{ old('location') }}" maxlength="255" required
                   class="form-control @error('location') is-invalid @enderror">
            @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-4">
            <label class="form-label">Capacity *</label>
            <input type="number" name="capacity" min="1" max="1000" value="{{ old('capacity') }}" required
                   class="form-control @error('capacity') is-invalid @enderror">
            @error('capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <button class="btn btn-primary">Create Event</button>
          </div>
        </form>
      </div>
    </div>

    {{-- existing + if an event is not there --}}
    <div class="card">
      <div class="card-header fw-semibold">Your Events</div>
      <div class="card-body p-0">
        @if($myEvents->isEmpty())
          <p class="p-3 text-muted mb-0">You haven’t created any events yet.</p>
        @else
          <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Starts</th>
                  <th>Location</th>
                  <th>Capacity</th>
                  <th>Bookings</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($myEvents as $event)
                  <tr>
                    <td><a href="{{ route('events.show', $event) }}">{{ $event->title }}</a></td>
                    <td>{{ optional($event->starts_at)->format('d M Y, g:i a') }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->capacity }}</td>
                    <td>{{ $event->bookings_count }}</td>
                    <td class="text-end">
                      
                      <a class="btn btn-sm btn-outline-secondary" href="{{ route('organiser.events.edit', $event) }}">
                        Edit
                      </a>

                      @if($event->bookings_count == 0)
                        <form method="POST" action="{{ route('organiser.events.destroy', $event) }}" class="d-inline"
                              onsubmit="return confirm('Delete this event?')">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                      @else
                        <button class="btn btn-sm btn-outline-danger" disabled
                                title="This event has bookings and cannot be deleted.">
                          Delete
                        </button>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="p-3">
            {{ $myEvents->links('pagination::bootstrap-5') }}
          </div>
        @endif
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
