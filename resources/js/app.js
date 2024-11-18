import './bootstrap';

import { createApp } from 'vue';
const app = createApp({});

import indexComponent from './components/index.vue';
app.component('index', indexComponent);

import router from './router/router';
app.use(router);

import store from './store';
app.use(store);

app.mount('#app');