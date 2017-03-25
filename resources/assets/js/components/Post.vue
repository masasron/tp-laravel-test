<!--

Post component.

| Option    | Default | Description                             |
|===========|=========|=========================================|
| post      | null    | Post object.                            |

Usage:
<post :post='postObject'></post>

-->

<template>
    <div>
        <h3>{{ post.title }}</h3>
        <p>{{ post.body }}</p>
        <router-link :to="{ name: 'post', params: { id: post.id}}">Rate & Review</router-link>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                required: true
            }
        },
    }
</script>
