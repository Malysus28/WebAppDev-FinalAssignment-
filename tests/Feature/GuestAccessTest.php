<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GuestAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        //EventFactory requires an organiser to exist
        User::factory()->create([
            'name'     => 'Organiser One',
            'email'    => 'organiser1@example.com',
            'password' => bcrypt('password'),
            'type'     => User::TYPE_ORGANISER,
        ]);
    }

    #[Test]
    public function a_guest_can_view_a_specific_event_details_page(): void
    {
        $event = Event::factory()->create([
            'title'       => 'Public Details Event',
            'location'    => 'South Bank',
            'starts_at'   => Carbon::now()->addDays(3),
            'description' => 'This is visible to guests.',
        ]);

        $res = $this->get("/events/{$event->id}");
        $res->assertOk();
        $res->assertSee('Public Details Event');
        $res->assertSee('South Bank');
        $res->assertSee('This is visible to guests.');
    }

    #[Test]
    public function a_guest_is_redirected_when_accessing_protected_routes(): void
    {
        
        $this->get('/dashboard')->assertRedirect('/login');
    }

    #[Test]
    public function a_guest_cannot_see_action_buttons_on_event_details_page(): void
    {
        $event = Event::factory()->create([
            'title'     => 'No Actions For Guests',
            'starts_at' => Carbon::now()->addDay(),
        ]);

        $res = $this->get("/events/{$event->id}");
        $res->assertOk();
        $res->assertSee('No Actions For Guests');

      
        $res->assertDontSee('Create Event');
        $res->assertDontSee('Edit');
        $res->assertDontSee('Delete');
        $res->assertDontSee('Manage Bookings');
    }
}
