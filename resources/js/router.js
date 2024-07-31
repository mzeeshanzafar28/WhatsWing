import { createMemoryHistory, createRouter } from 'vue-router';
import Register from './Pages/Auth/Register.vue';
import Login from './Pages/Auth/Login.vue';
import Welcome from './Pages/Welcome.vue';

const routes = [
    { path: '/', name: 'Welcome', component: Welcome },
    { path: '/login', name: 'Login', component: Login, children: [] },
    { path: '/register', name: 'Register', component: Register, children: [] },
    { path: '/:pathMatch(.*)*', redirect: '/' }

];

const router = createRouter({
    history: createMemoryHistory(),
    routes,
});

export default router;
