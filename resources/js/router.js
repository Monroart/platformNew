import vueRouter from 'vue-router';
import Vue from 'vue';
import store from "./store";


Vue.use(vueRouter);

import Index from "./views/index/Index";
import Profile from "./views/profile/Profile";
import Login from "./views/auth/Login";
import Courses from "./views/courses/Courses";
import Homeworks from "./views/homeworks/Homeworks";
import Compiler from "./views/compiler/Compiler";

const routes = [
    {
        path: '/',
        name: 'Index',
        component: Index
    },
    {
        path: '/profile',
        component: Profile
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/courses',
        component: Courses
    },
    {
        path: '/homeworks',
        component: Homeworks
    },
    {
        path: '/compile',
        component: Compiler
    }
];

const router = new vueRouter({
    mode: "history",
    routes: routes
});

router.beforeEach(( to, from, next) => {

    const token = localStorage.getItem('x_xsrf_token')

    if(!token){
        if(to.path === '/login'){
            return next()
        }
        else {
            return next('/login')
        }
    }

    if(to.path === '/login' && token){
        return next('/')
    }
    next()
})

export default router
