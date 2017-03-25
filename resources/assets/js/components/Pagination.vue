<!--

A basic pagination component.

| Option    | Default | Description                             |
|===========|=========|=========================================|
| resource  | null    | Restfull pagination object.             |

Events:
change - triggered when page selection changes.

Usage:
<pagination v-on:change='notify' :resource='paginationObject'></pagination>

-->

<template>
    <div>
        <h4 class="pull-left">Displaying {{ resource.from }} - {{ resource.to }} results.</h4>
        <ul class="pagination pull-right">
            <li v-on:click="setPage(page)" v-for="page in pages" v-bind:class="{active: page == current_page }">
                <a href="#">{{ page }}</a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</template>

<script>
    export default {
        props: {
            resource: {
                type: Object,
                required: true
            }
        },
        computed: {
            pages: function() {
                var pages = []
                for (var i = 1; i <= this.resource.last_page; i++) {
                    pages.push(i);
                }
                return pages;
            }
        },
        data: function() {
            return {
                current_page: null,
            }
        },
        mounted() {
            this.current_page = this.resource.current_page
        },
        methods: {
            setPage: function(page) {
                if (this.current_page == page) {
                    return
                }
                this.current_page = page
                this.$emit('change', page)
            }
        }
    }
</script>
