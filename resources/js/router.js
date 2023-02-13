import vueRouter from 'vue-router';
import Vue from 'vue';
import store from "./store";


Vue.use(vueRouter);

import Index from "./views/index/Index";
import Profile from "./views/profile/Profile";
import Login from "./views/auth/Login";
import Courses from "./views/courses/Courses";
import Homeworks from "./views/homeworks/Homeworks";
import CourseView from "./views/courses/CourseView";
import StudentHomework from "./components/homeworks/StudentHomework";

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
        path: '/course',
        name: 'courseId',
        props: routes => ({course_id: routes.query.course_id, course_name: routes.query.course_name, course_length: routes.query.course_length}),
        component: CourseView,
    },
    {
        path: '/studenthomeworks',
        name: 'studenthomeworks',
        props: routes => ({lesson_id: routes.query.lesson_id}),
        component: StudentHomework,
    },
    {
        path: '/homeworks',
        component: Homeworks
    },
];

const router = new vueRouter({
    mode: "history",
    routes: routes
});

router.beforeEach(( to, from, next) => {

    const token = localStorage.getItem('x_xsrf_token')

    if(!token) {
        if(to.path === '/login'){
            return next()
        }
        else {
            return next('/login')
        }
    }

    if(to.path === '/login' && token) {
        return next('/')
    }

    if(token) {
        store.dispatch('auth/login', false)
    }

    next()
})

export default router
