import { createRouter, createWebHistory} from 'vue-router';

const routes = [
    {
        path: '/BirthdayMailingList/public/user/login', component: () => import('./components/User/Login.vue'),
        name: 'user.login'
    },
    {
        path: '/BirthdayMailingList/public/user/registration', component: () => import('./components/User/Registration.vue'),
        name: 'user.registration'
    },
    {
        path: '/BirthdayMailingList/public/user/personal', component: () => import('./components/User/Personal.vue'),
        name: 'user.personal'
    },
    {
        path: '/BirthdayMailingList/public/guests/create', component: () => import('./components/Guest/Create.vue'),
        name: 'guest.create'
    },
    {
        path: '/BirthdayMailingList/public/newsletters/', component: () => import('./components/Newsletter/Create.vue'),
        name: 'newsletter.create'
    },
    {
        path: '/BirthdayMailingList/public/newsletters/statistics/', component: () => import('./components/Newsletter/Statistics/Index.vue'),
        name: 'statistics.index'
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token')

    if (!token) {
        if (to.name === 'user.login' || to.name === 'user.registration') {
            return next();
        } else {
            return next({
                name: 'user.login'
            })
        }
    }

    if (to.name === 'user.login' || to.name === 'user.registration' && token) {
        return next({
            name: 'user.personal'
        })
    }

    next()
})

export default router;