<!--

An interface for adding reviews on a post.

| Option    | Default | Description                             |
|===========|=========|=========================================|
| post_id   | null    | Id of the post we review.               |

Events:
success - triggered when a review was added.

Usage:
<UserReview :post_id="1" v-on:success="loadPostReviews"></UserReview>

-->

<template>
    <div>
        <form v-on:submit.prevent="store">
            <div v-if="!loading">
                <div class="form-group">
                  <label for="comment">Subject</label>
                  <input type="text" minlength="10" class="form-control" v-model="review.subject" required></textarea>
                </div>
                <div class="form-group">
                  <label for="comment">Review</label>
                  <textarea minlength="50" class="form-control" rows="5" v-model="review.body" required></textarea>
                </div>
                <button>Submit Review</button>
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
            }
        },
        data() {
            return {
                loading: false,
                review: {
                    subject: null,
                    body: null
                },
            }
        },
        methods: {
            store: function() {
                this.loading = true
                this.$http.post(`post/${this.post_id}/reviews`, this.review).then(function() {
                    this.$emit('success')
                    this.review.subject = ''
                    this.review.body = ''
                }).then(function() {
                    this.loading = false
                })
            }
        }
    }
</script>
