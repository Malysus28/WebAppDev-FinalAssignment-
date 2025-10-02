<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Event</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  @include('navbar')

  <main class="container py-4">
    <h1 class="mb-4">Edit Event</h1>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div> @endif
    @if($errors->any())
      <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <form method="POST" action="{{ route('organiser.events.update', $event) }}" class="row g-3">
      @csrf
      @method('PUT') 

      <div class="col-12">
        <label class="form-label">Title *</label>
        <input type="text" name="title" value="{{ old('title', $event->title) }}" maxlength="100" required
               class="form-control @error('title') is-invalid @enderror">
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $event->description) }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-md-4">
        <label class="form-label">Date &amp; Time *</label>
        <input type="datetime-local" name="starts_at"
               value="{{ old('starts_at', optional($event->starts_at)->format('Y-m-d\TH:i')) }}"
               required class="form-control @error('starts_at') is-invalid @enderror">
        @error('starts_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-md-4">
        <label class="form-label">Location *</label>
        <input type="text" name="location" value="{{ old('location', $event->location) }}" maxlength="255" required
               class="form-control @error('location') is-invalid @enderror">
        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-md-4">
        <label class="form-label">Capacity *</label>
        <input type="number" name="capacity" min="1" max="1000" value="{{ old('capacity', $event->capacity) }}" required
               class="form-control @error('capacity') is-invalid @enderror">
        @error('capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

@php
  $selected = old('categories', $event->categories ?? []);
@endphp

<div class="mb-3">
  <label class="form-label fw-semibold">Categories</label>
  <div class="d-flex flex-wrap gap-3">
    @foreach (($allCategories ?? []) as $cat)
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="categories[]"
               id="cat_{{ $cat }}" value="{{ $cat }}"
               {{ in_array($cat, $selected ?? [], true) ? 'checked' : '' }}>
        <label class="form-check-label" for="cat_{{ $cat }}">{{ $cat }}</label>
      </div>
    @endforeach
  </div>
  @error('categories') <div class="text-danger small">{{ $message }}</div> @enderror
  @error('categories.*') <div class="text-danger small">{{ $message }}</div> @enderror
</div>



      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary">Save changes</button>
        <a href="{{ route('organiser.events.manage') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </main>
</body>
</html>
