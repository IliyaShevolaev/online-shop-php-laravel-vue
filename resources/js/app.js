import './bootstrap';

import { createApp } from 'vue';
const app = createApp({});

import indexComponent from './components/index.vue';
app.component('index', indexComponent);

app.mount('#app');