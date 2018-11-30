<template>
    <div>
        <div>
            <h1 class="display-3 text-center"><img src="https://www.medoucine.com/images/logos/logo.svg" width="350"/></h1>
        </div>

        <form v-on:submit.prevent="onSubmit" class="row offset-2 col-8">
            <select v-model="city" @change="setCity(city)" class="col-4 custom-select">
                <option selected>Choisir une ville</option>
                <option v-for="(city, index) in links" :value="index">{{ index }}</option>
            </select>

            <select v-model="practice" @change="setPractice(practice)" class="col-4 custom-select">
                <option selected>Choisir une spécialité</option>
                <option v-for="practice in linkedPracticesToSelectedCity" :value="practice">{{ practice }}</option>
            </select>

            <button class="btn btn-primary col-4" @submit="onSubmit()">ENVOYER</button>
        </form>

        <div id="doctors" class="row offset-2 col-8">
            <doctor-card-component v-for="(doctor, key) in doctors"
                              v-bind:doctor="doctor" v-bind:key="key">
            </doctor-card-component>
        </div>

        <div style="border-top: 1px solid #dbe0e0">
            <div id="links" class="row offset-2 col-8">
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
    export default {
        data() {
            return {
                city: null,
                doctors: [],
                linkedPracticesToSelectedCity: [],
                links: [],
                practice: null
            }
        },
        created() {
            window.axios.get('/links').then(response => this.links = response.data);
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
                this.doctors = [];
            },
            setPractice(practice) {
                this.practice = practice;
            },
            search(city, practice) {
                let params = {city, practice, searchType: 'search_by_city_and_practice'};
                window.axios.post('/search', params).then(response => this.doctors = response.data);
            }
        }
    }
</script>
