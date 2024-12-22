import { createRouter, createWebHashHistory } from "vue-router";

const Home = () => import('../components/Home.vue')
const Register = () => import('../components/auth/Register.vue')
const Login = () => import('../components/auth/Login.vue')


const router = createRouter({
     history: createWebHashHistory(),
     routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        }, 
        {
            path: '/Login',
            name: 'login',
            component: Login
        },
     ]
})

export default router