import { createRouter, createWebHistory } from 'vue-router'
import routes from './routes';
import { setUpRouteGuards } from './route-guards';

const router = createRouter({
    history: createWebHistory(),
    routes
});

setUpRouteGuards(router);

export default router;