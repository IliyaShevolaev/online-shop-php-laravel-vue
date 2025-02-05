const routes = [
    {
        path: '/',
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
        meta: { requiresAuth: true },
        component: () => import('../components/pages/Profile.vue'),
    },

    {
        path: '/favorites',
        name: 'page.favorites',
        meta: { requiresAuth: true },
        component: () => import('../components/pages/Favorites.vue'),
    },

    {
        path: '/profile/orders',
        name: 'page.profile.orders',
        meta: { requiresAuth: true },
        component: () => import('../components/pages/Orders.vue'),
    },

    {
        path: '/profile/order/:id',
        name: 'page.profile.orders.order',
        meta: { requiresAuth: true },
        props: true,
        component: () => import('../components/pages/OrderView.vue'),
    },

    {
        path: '/product/show/:id',
        name: 'product.show',
        props: true,
        component: () => import('../components/product/ShowCard.vue'),
    },

    {
        path: '/product/filter',
        name: 'product.filter',
        component: () => import('../components/product/ShowFilterCards.vue'),
    },
];

export default routes;