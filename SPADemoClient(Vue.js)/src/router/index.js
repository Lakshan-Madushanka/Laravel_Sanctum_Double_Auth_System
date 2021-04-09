import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import store from '../store/index'
console.log(store.getters.authData.isAuthenticated);
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/users/signin',
    name: 'signin',
    component: () => import('../views/auth/Signin'),
    
  },
  {
    path: '/users/signup',
    name: 'signup',
    component: () => import('../views/auth/Signup')
  },

  {
    path: '/admin/dashboard',
    name: 'adminDashboard',
    component: () => import('../views/admin/Dashboard')
  },

  {
    path: '/not_found',
    name: 'notFound',
    component: () => import('../views/errors/404')

  },

  {
    path: '/server_error',
    name: 'serverError',
    component: () => import('../views/errors/500')

  },

  {
    path: '/bad_request',
    name: 'badRequest',
    component: () => import('../views/errors/BadRequest')

  },

	{ path: "/:catchAll(.*)", redirect: { name: 'notFound' } },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
