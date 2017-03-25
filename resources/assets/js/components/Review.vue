<!--

Review component.

| Option    | Default | Description                             |
|===========|=========|=========================================|
| review    | null    | Review object.                          |

Usage:
<review :review='reviewObject'></review>

-->

<template>
    <div>
        <h4>{{ review.subject }} <small>Reviewed by {{ review.user.name }} at {{ review.created_at }}.</small></h4>
        <p>{{ review.body }}</p>
        <hr />
    </div>
</template>

<script>
    export default {
        props: {
            review: {
                type: Object,
                required: true
            }
        }
    }
</script>
