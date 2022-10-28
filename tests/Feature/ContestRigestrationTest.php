<?php

namespace Tests\Feature;

use App\Events\NewCustomerEntryReceivedEvent;
use App\Mail\WelcomeContestEntryMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContestRigestrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void 
    {
        parent::setUp();
        
        // OLD Implementation when we faked events on all test class
        // Event::fake([
        //     NewCustomerEntryReceivedEvent::class,
        // ]);

        Mail::fake();
    }

    /** @test */
    public function an_email_can_be_entered_into_the_contest()
    {
        // You can use it if you want know why exactly the test assertion fails
        // in short hands, its for debuging your test failure.
        // $this->withoutExceptionHandling();

        $this->post("/contests", [
            'email' => 'abc@abc.com',
        ]);

        $this->assertDatabaseCount('contest_entries', 1);
    }

    /** @test */
    public function email_is_required() 
    {
        $this->post("/contests", [
            'email' => '',
        ]);

        $this->assertDatabaseCount('contest_entries', 0);
    }

    /** @test */
    public function email_needs_to_be_an_email() 
    {
        $this->post("/contests", [
            'email' => 'abc',
        ]);

        $this->assertDatabaseCount('contest_entries', 0);
    }

    /** @test */
    public function an_event_is_fired_when_user_registers() 
    {
        Event::fake([
            NewCustomerEntryReceivedEvent::class,
        ]);

        $this->post("/contests", [
            'email' => 'abc@abc.com',
        ]);

        Event::assertDispatched(NewCustomerEntryReceivedEvent::class);
    }

    /** @test */
    public function a_welcome_email_is_sent() 
    {
        $this->post("/contests", [
            'email' => 'abc@abc.com',
        ]);

        // If you didn't implement the ShouldQueue Interface
        // Mail::assertSent(WelcomeContestEntryMail::class);
        
        // If you did implement the ShouldQueue Interface
        Mail::assertQueued(WelcomeContestEntryMail::class);
    }
}
