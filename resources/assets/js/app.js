import Vue from 'vue'

import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

import Post from './components/Post.vue'
import Loader from './components/Loader.vue'
import Review from './components/Review.vue'
import Pagination from './components/Pagination.vue'
import UserRating from './components/UserRating.vue'
import UserReview from './components/UserReview.vue'

import HomePage from './routes/HomePage.vue'
import PostPage from './routes/PostPage.vue'

Vue.use(VueRouter)
Vue.use(VueResource)

// Load global components
Vue.component('loader', Loader)

// Load route specific components.
HomePage.components = {
    Post,
    Pagination
}

PostPage.components = {
    Review,
    UserRating,
    UserReview
}

// Create our router.
const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    routes: [
    {
        // Our home page, in here we are going to display a list of our posts.
        path: '/home',
        name: 'home',
        component: HomePage
    },
    {
        // Our post page, in here we are going to put our reviews and rating.
        path: '/post/:id',
        name: 'post',
        component: PostPage
    }]
})

// Create our main vue application.
const App = new Vue({
    router,
}).$mount('#app')
