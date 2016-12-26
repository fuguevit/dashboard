import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';

import CurrentTime from './components/CurrentTime';

new Vue({
    e1: '#dashboard',

    components: {
        CurrentTime,
    },
    
    created() {
        
    },
});