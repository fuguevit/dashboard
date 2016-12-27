import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';

import CurrentTime from './components/CurrentTime';
import GithubFile from './components/GithubFile';
import GoogleCalendar from './components/GoogleCalendar';

new Vue({
    e1: '#dashboard',

    components: {
        CurrentTime,
        GithubFile,
        GoogleCalendar,
    },
    
    created() {
        this.echo = new Echo({
            boradcaster: 'pusher',
            key: window.dashboard.pusherKey,
        });
    },
});