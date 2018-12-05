<template>
    <div>
        <div class="bgc p10">
            <div>
                <h1 class="display-3 text-center"><img src="https://www.medoucine.com/images/logos/logo.svg" width="350"/></h1>
            </div>

            <form v-on:submit.prevent="onSubmit" class="row offset-2 col-8 mt30 mb20">
                <select v-model="city" @change="setCity(city)" class="col-4 custom-select">
                    <option>Choisir une ville</option>
                    <option v-for="(city, index) in links" :value="index">{{ index }}</option>
                </select>

                <select v-model="practice" @change="setPractice(practice)" class="col-4 custom-select">
                    <option>Choisir une spécialité</option>
                    <option v-for="practice in linkedPracticesToSelectedCity" :value="practice">{{ practice }}</option>
                </select>

                <button class="btn btn-primary col-4" @submit="onSubmit()">ENVOYER</button>
            </form>
        </div>

        <div id="doctors" class="row offset-2 col-8">
            <doctor-component v-for="(doctor, key) in doctors"
                              v-bind:doctor="doctor" v-bind:key="key">
            </doctor-component>
        </div>

        <div class="bt1 mt20">
            <div id="links" class="row mt10 offset-2 col-8">
                <link-component v-for="(city, index) in links"
                                :class="'col-' + [12 / Object.keys(links).length]"
                                v-bind:city="city" v-bind:cityName="index" v-bind:key="index"
                                @onLinkClick="onLinkClick">
                </link-component>
            </div>
        </div>
    </div>
</template>

<script>
    import { store } from '../store/index'
    export default {
        computed: {
            doctors() {
                return store.doctors.getters.doctors
            },
            links() {
                return store.links.getters.links
            }
        },
        data() {
            return {
                city: null,
                linkedPracticesToSelectedCity: [],
                practice: null
            }
        },
        created() {
            store.links.dispatch('setLinks')
        },
        methods: {
            onLinkClick([cityName, practice]) {
                this.setCity(cityName);
                this.setPractice(practice);
                this.search(cityName, practice);
            },
            onSubmit() {
                if (this.city && this.practice) {
                    this.search(this.city, this.practice)
                }
            },
            setCity(city) {
                this.linkedPracticesToSelectedCity = this.links[city];
                this.city = city;
                this.practice = null;
                store.links.dispatch('setLinkHighlight', undefined);
                store.doctors.dispatch('setDoctors', null)
            },
            setPractice(practice) {
                this.practice = practice;
            },
            search(city, practice) {
                console.log(city, practice);
                let params = {city, practice, searchType: 'search_by_city_and_practice'};
                store.links.dispatch('setLinkHighlight', city + practice);
                store.doctors.dispatch('setDoctors', params);
            }
        }
    }
</script>
<style scoped>
    select, button {
        border-radius: 0;
    }
    .bgc {
        background-color: #ECF1F4;
    }
</style>