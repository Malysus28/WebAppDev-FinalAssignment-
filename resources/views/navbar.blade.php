<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="{{ route('home') }}">Event Finder</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
            aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home','events.index') ? 'active' : '' }}" href="{{ route('home') }}">
            Events
          </a>
        </li>

        {{-- Role-based items --}}
        @auth
          @php($user = auth()->user()) {{-- EDIT: cache user & allow null-safe --}}
          
          @if($user?->type === \App\Models\User::TYPE_ORGANISER) {{-- EDIT: null-safe --}}
            @if (Route::has('events.create'))
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('events.create') ? 'active' : '' }}" href="{{ route('events.create') }}">
                  Create Event
                </a>
              </li>
            @endif

            @if (Route::has('dashboard'))
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                  Dashboard
                </a>
              </li>
            @endif
          @endif

          @if($user?->type === \App\Models\User::TYPE_ATTENDEE) {{-- EDIT: null-safe --}}
            @if (Route::has('bookings.index'))
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('bookings.index') ? 'active' : '' }}" href="{{ route('bookings.index') }}">
                  My Bookings
                </a>
              </li>
            @endif
          @endif
        @endauth
      </ul>

      <ul class="navbar-nav ms-auto align-items-center">
        @auth
          <li class="nav-item me-3 text-muted small">
            {{ auth()->user()->name }} · {{ auth()->user()->type }}
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
          </li>
        @else
          @if (Route::has('login'))
            <li class="nav-item me-2">
              <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Login</a>
            </li>
          @endif
          @if (Route::has('register'))
            <li class="nav-item">
              <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Register</a>
            </li>
          @endif
        @endauth
      </ul>
    </div>
  </div>
</nav>
