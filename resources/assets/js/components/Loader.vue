<!--

A simple loading animation component.

| Option    | Default | Description                             |
|===========|=========|=========================================|
| size      | 45      | height and width of the loader element. |
| alignment | center  | 'center','left','right'                 |

Usage:
<loader></loader>
<loader :size='45'></loader>
<loader alignment='left' :size='15'></loader>

-->

<template>
    <div v-bind:class="alignment_class">
        <img :width="size" :height="size" src="/images/spin.svg" />
    </div>
</template>

<script>
    export default {
        props: {
            alignment: {
                type: String,
                default: 'center'
            },
            size: {
                type: Number,
                default: 45
            }
        },
        computed: {
            alignment_class() {
                let _alignment = {}
                _alignment[`text-${this.alignment}`] = true
                return _alignment
            }
        }
    }
</script>
