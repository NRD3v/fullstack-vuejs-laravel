<template>
    <div>
        <h6>{{ cityName }}</h6>
        <ul>
            <li class="small" v-for="practice in city" :class="{highlight:cityName + practice === linkHighlighted}">
                <a href="#" @click="onClick(cityName, practice)">{{ practice }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    import { store } from '../store/index'
    export default {
        computed: {
            linkHighlighted() {
                return store.links.getters.linkHighlighted
            }
        },
        methods: {
          onClick(cityName, practice) {
              store.links.dispatch('setLinkHighlight', cityName + practice);
              this.$emit('onLinkClick', [cityName, practice])
          }
        },
        props: ['city', 'cityName']
    }
</script>

<style scoped>
    li.highlight {
        font-weight: bold;
    }
</style>
