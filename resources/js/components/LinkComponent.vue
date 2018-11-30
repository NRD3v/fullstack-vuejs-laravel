<template>
    <div>
        <h6>{{ cityName }}</h6>
        <ul>
            <li class="small" v-for="practice in city">
                <a href="#" @click="onClick(cityName, practice)">{{ practice }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        methods: {
          onClick(cityName, practice) {
              this.$emit('onLinkClick', [cityName, practice])
          }
        },
        props: ['city', 'cityName']
    }
</script>
