<?php

namespace App\Components\GoogleCalendar;

use App\Events\GoogleCalendar\EventsFetched;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;
use Spatie\GoogleCalendar\Event;

class FetchGoogleCalendarEvents extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:calendar {--debug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Google Calendar events.';

    public function handle()
    {
        $events = collect(Event::get())
            ->map(function (Event $event) {
                return [
                    'name'  => $event->name,
                    'date'  => Carbon::createFromFormat('Y-m-d H:i:s', $event->getSortDate())->format(DateTime::ATOM),
                ];
            })
            ->unique('name')
            ->toArray();

        if ($this->option('debug')) {
            if (count($events) == 0) {
                $this->info('no events.');
            } else {
                $this->info(var_dump($events));
            }

            return;
        }

        event(new EventsFetched($events));
    }
}
