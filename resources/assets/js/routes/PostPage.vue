<template>
    <div>
        <div v-if="post">
            <h1>{{ post.title }}</h1>
            <p>{{ post.body }}</p>
        </div>
        <div v-else>
            <loader></loader>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <h3>Average Rating</h3>
                <div v-if="rating">
                    <strong>{{ parseFloat(rating.average_rating).toFixed(2) }}</strong> out of 5
                </div>
                <loader v-else alignment="left" :size="25"></loader>
            </div>
            <div class="col-md-6">
                <h3>Your Rating</h3>
                <UserRating v-if="rating"
                            v-on:change="loadPostRating"
                            :post_id="$route.params.id"
                            :rating="rating.user_rating"></UserRating>
                <loader v-else alignment="left" :size="25"></loader>
            </div>
        </div>
        <hr />
        <h3>Reviews</h3>
        <div v-if="reviews">
            <review v-for="review in reviews.data" :key="review.id" v-bind:review="review"></review>
        </div>
        <loader v-else alignment="left" :size="25"></loader>
        <h3>Write a Review</h3>
        <UserReview :post_id="$route.params.id" v-on:success="loadPostReviews"></UserReview>
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
        data() {
            return {
                post: null,
                reviews: null,
                rating: null,
                post_id: null,
            }
        },
        mounted() {
            this.post_id = this.$route.params.id

            this.loadPost()
            this.loadPostRating()
            this.loadPostReviews()
        },
        methods: {
            loadPost() {
                this.$http.get(`post/${this.post_id}`).then(function(response) {
                    this.post = response.body
                })
            },
            loadPostReviews() {
                this.$http.get(`post/${this.post_id}/reviews`).then(function(response) {
                    this.reviews = response.body
                })
            },
            loadPostRating() {
                this.$http.get(`post/${this.post_id}/rating`).then(function(response) {
                    this.rating = response.body
                })
            }
        }
    }
</script>
