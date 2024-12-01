export function setUpRouteGuards(router) {
    router.beforeEach((to, from, next) => {
        let isAuth = localStorage.getItem('auth');
    
        if (!isAuth && to.meta.requiresAuth) {
            next('/')
        } else {
            next();
        }
    });
}