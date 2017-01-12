import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';

import CurrentTime from './components/CurrentTime';
import GithubFile from './components/GithubFile';
import GoogleCalendar from './components/GoogleCalendar';
import InternetConnection from './components/InternetConnection';
import LastFm from './components/LastFm';
import RainForecast from './components/RainForecast';
import PackagistStatistics from './components/PackagistStatistics';

new Vue({

    el: '#dashboard',

    components: {
        CurrentTime,
        GithubFile,
        GoogleCalendar,
        InternetConnection,
        LastFm,
        RainForecast,
        PackagistStatistics
    },

    created() {
        this.echo = new Echo({
            broadcaster: 'pusher',
            key: window.pusherKey,
        });
    },
});