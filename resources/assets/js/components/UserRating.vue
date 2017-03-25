<!--

An interface for adding or updating the rating of a post.

| Option    | Default | Description                             |
|===========|=========|=========================================|
| resource  | null    | Restfull pagination object.             |
| post_id   | null    | Id of the post we rate.                 |

Events:
change - triggered when post rating updates.

Usage:
<UserRating v-on:change='notify' :post_id='1'></UserRating>

-->

<template>
    <div>
        <form v-on:submit.prevent="store">
            <div v-if="!loading">
                <input type="number" v-model="stars" max="5" min="1" required />
                <button>Rate!</button>
            </div>
            <loader v-else alignment="left" :size="25"></loader>
        </form>
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
        props: {
            post_id: {
                required: true,
            },
            rating: {
                default: 1,
            }
        },
        data() {
            return {
                loading: false,
                stars: null,
            }
        },
        mounted() {
            this.stars = parseInt(this.rating)
        },
        methods: {
            store: function() {
                this.loading = true
                this.$http.post(`post/${this.post_id}/rating`, {
                    stars: this.stars
                }).then(function() {
                    this.$emit('change')
                }).then(function() {
                    this.loading = false
                })
            }
        }
    }
</script>
