const routes = [
    {
        path: '/main',
        name: 'page.main',
        component: () => import('../components/pages/MainPage.vue'),
    },

    {
        path: '/cart',
        name: 'page.cart',
        component: () => import('../components/pages/Cart.vue'),
    },

    {
        path: '/profile',
        name: 'page.profile',
        component: () => import('../components/pages/Profile.vue'),
    },

    {
        path: '/favorites',
        name: 'page.favorites',
        component: () => import('../components/pages/Favorites.vue'),
    },
];

export default routes;