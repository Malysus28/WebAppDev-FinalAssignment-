<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function __construct()
{
    $this->middleware('auth')->except(['index', 'show']);
}
    public function index(){
        $events=Event::with('organiser')
        ->withCount('bookings')
        ->upcoming()
        ->paginate(8);
        return view('events.index',compact('events'));
    }
    public function show (Event $event){
        $event->load('organiser','bookings');
        return view('events.show',compact('event'));
    }

public function create()
{ $this->authorize('create', \App\Models\Event::class);
    return view('events.create');
}

public function store(Request $request)
{ $this->authorize('create', \App\Models\Event::class);
    $data = $request->validate([
        'title'       => ['required','max:100'],
        'description' => ['nullable','string'],
        'starts_at'   => ['required','date','after:now'],
        'location'    => ['required','max:255'],
        'capacity'    => ['required','integer','min:1','max:1000'],
    ]);
    $data['organiser_id'] = auth()->id();
    \App\Models\Event::create($data);
        return redirect()
            ->route('organiser.events.manage')
            ->with('success', 'Event created.');
}

public function edit(Event $event)
{$this->authorize('update', $event);
    return view('events.edit', compact('event'));
}

public function update(Request $request, Event $event)
{$this->authorize('update', $event);
    $data = $request->validate([
        'title'       => ['required','max:100'],
        'description' => ['nullable','string'],
        'starts_at'   => ['required','date','after:now'],
        'location'    => ['required','max:255'],
        'capacity'    => ['required','integer','min:1','max:1000'],
    ]);
    $event->update($data);
    return redirect()
        ->route('organiser.events.manage')
        ->with('success', 'Event updated.');
}

public function destroy(Event $event)
{ $this->authorize('delete', $event);
    if ($event->bookings()->exists()) {
        return back()->with('error', 'Cannot delete an event that has bookings.');
    }
    $event->delete();
    return redirect()
        ->route('organiser.events.manage')
        ->with('success', 'Event deleted.');
}

public function manage(Request $request)
{abort_unless(auth()->user()->type === User::TYPE_ORGANISER, 403);
    $myEvents = Event::where('organiser_id', auth()->id())
        ->withCount('bookings')
        ->orderBy('starts_at')
        ->paginate(10);
    return view('events.manage', compact('myEvents'));
}

}