<template>
    <div>
        <div v-if="posts">
            <pagination v-on:change="getPosts(arguments[0])" v-bind:resource="posts"></pagination>
            <hr />
            <post v-for="post in posts.data"
                  v-bind:key="post.id"
                  v-bind:post="post"></post>
        </div>
        <div v-else>
            <loader></loader>
        </div>
    </div>
</template>

<script>
    export default {
        http: {
            root: '/api/v1',
            headers: {
                Authorization: `Bearer ${window.User.api_token}`
            }
        },
        data(){
            return {
                posts: null
            }
        },
        mounted(){
            this.getPosts()
        },
        methods: {
            getPosts(page = 1){
                this.posts = null
                this.$http.get('post',{
                    params: {page: page}
                }).then(function(response){
                    this.posts = response.body
                })
            }
        }
    }
</script>
