const routes = [
    {
        path: '/shop',
        name: 'shop.index',
        component: () => import('../components/TestShop.vue'),
    },
];

export default routes;