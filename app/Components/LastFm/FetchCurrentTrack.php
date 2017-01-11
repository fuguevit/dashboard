<?php

namespace App\Components\LastFm;

use App\Events\LastFm\NothingPlaying;
use App\Events\LastFm\TrackIsPlaying;
use Illuminate\Console\Command;
use Spatie\NowPlaying\NowPlaying;

class FetchCurrentTrack extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:lastFm {--debug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the currently playing track from last fm.';

    /**
     * Event the console command.
     *
     * @throws \Spatie\NowPlaying\Exceptions\BadResponse
     *
     * @return mixed
     */
    public function handle()
    {
        $lastFm = new NowPlaying(config('last-fm.api_key'));
        $userName = config('last-fm.user');
        $currentTrack = $lastFm->getTrackInfo($userName);

        if ($this->option('debug')) {
            $this->info(var_dump($currentTrack));

            return;
        }

        if ($currentTrack) {
            event(new TrackIsPlaying($currentTrack, $userName));

            return;
        }

        event(new NothingPlaying());
    }
}
