<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
  <div class="container">
<a class="navbar-brand fw-semibold" href="{{ route('home') }}" style="color:#ff7a00;">
  Event Finder
</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
            aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        {{-- Always visible event page link --}}
        <li class="nav-item">
          <a class="nav-link text-light {{ request()->routeIs('home','events.index') ? 'active' : '' }}" href="{{ route('home') }}">
            Events
          </a>
        </li>

        {{-- Role-based items:if user is an organiser this is shown--}}
        @auth
          @php($user = auth()->user()) 
          
          @if($user?->type === \App\Models\User::TYPE_ORGANISER) 

          {{-- This link takes the organiser to the page where they can create, edit, and delete events --}}

            @if (Route::has('events.create'))
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('organiser.events.*') ? 'active' : '' }}" href="{{ route('organiser.events.manage') }}">
                  Manage Events
                </a>
            @endif

            {{-- This link takes the organiser to their profile/dashboard i probably wont need this by the end --}}
            @if (Route::has('dashboard'))
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                  Dashboard
                </a>
              </li>
            @endif
          @endif

{{-- if user is an attendee this is shown, this is not fully implemented yet --}}
          @if($user?->type === \App\Models\User::TYPE_ATTENDEE) 
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


      {{-- if user is logged in --}}
      <ul class="navbar-nav ms-auto align-items-center">
        @auth
          <li class="nav-item me-3 small" style="color: #ff7a00;">
            {{ auth()->user()->name }} · {{ auth()->user()->type }}
          </li>

          {{-- Logout button --}}
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
          </li>


        @else
        {{-- Login btn --}}
          @if (Route::has('login'))
            <li class="nav-item me-2">
              <a class="btn btn-outline-success btn-sm" href="{{ route('login') }}">Login</a>
            </li>
          @endif

          {{-- If user is NOT logged in, show Login and Register buttons --}}
          @if (Route::has('register'))
            <li class="nav-item me-2">
              <a class="btn btn-outline-info btn-sm" href="{{ route('register') }}">Register</a>
            </li>
          @endif


    {{-- Organiser login btn --}}
  <li class="nav-item me-2">
    <a class="btn btn-outline-warning btn-sm" href="{{ route('login', ['role' => 'organiser']) }}">
      Organiser Login
    </a>
  </li>
        @endauth
      </ul>
    </div>
  </div>

</nav>