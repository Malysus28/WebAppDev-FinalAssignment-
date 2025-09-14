<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><title>Create Event</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
@include('navbar')
  <div class="container py-4" style="max-width:800px;">
    <h1 class="h4 mb-3">Create Event</h1>

    <form method="POST" action="{{ route('events.store') }}" class="vstack gap-3">
      @csrf

      <div>
        <label class="form-label">Title</label>
        <input name="title" class="form-control" maxlength="100" required value="{{ old('title') }}">
        @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
      </div>

      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Date & Time</label>
          <input name="starts_at" type="datetime-local" class="form-control" required value="{{ old('starts_at') }}">
          @error('starts_at')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Capacity</label>
          <input name="capacity" type="number" min="1" max="1000" class="form-control" required value="{{ old('capacity') }}">
          @error('capacity')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
      </div>

      <div>
        <label class="form-label">Location</label>
        <input name="location" class="form-control" maxlength="255" required value="{{ old('location') }}">
        @error('location')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>

      <div class="d-flex gap-2">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Cancel</a>
        <button class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</body>
</html>
