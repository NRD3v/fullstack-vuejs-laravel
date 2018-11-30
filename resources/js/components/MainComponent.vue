<template>
    <div>
        <div>
            <h1 class="display-3 text-center"><img src="https://www.medoucine.com/images/logos/logo.svg" width="350"/></h1>
        </div>

        <form v-on:submit.prevent="onSubmit" class="row offset-2 col-8">
            <select v-model="city" @change="setCity(city)" class="col-4">
                <option value="" disabled selected>Choisir une ville</option>
                <option v-for="(city, index) in links" :value="index">{{ index }}</option>
            </select>

            <select v-model="practice" @change="setPractice(practice)" class="col-4">
                <option value="" disabled selected>Choisir une spécialité</option>
                <option v-for="practice in linkedPracticesToSelectedCity" :value="practice">{{ practice }}</option>
            </select>

            <button class="btn btn-info col-4" @submit="onSubmit()">ENVOYER</button>
        </form>

        <div id="doctors" class="row offset-2 col-8">
            <div v-if="doctor" class="col-6" v-for="doctor in doctors">
                <div class="row" style="border: 1px solid #dbe0e0; border-radius: 2px;">
                    <div class="col-4 align-middle" style="vertical-align: middle">
                        <img src="../../img/Photo.jpg" width="75" style="border-radius: 2px">
                    </div>
                    <div class="col-8">
                        <h5>{{ doctor.name }}</h5>
                        <h5>{{ doctor.city }}</h5>
                        <p class="small">
                    <span v-for="(practice, index) in doctor.practice">
                        <span>{{ practice }}</span><span v-if="index + 1 < doctor.practice.length">, </span>
                    </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <footer style="border-top: 1px solid #dbe0e0">
            <div id="links" class="row offset-2 col-8">
                <div v-for="(city, index) in links" :class="'col-' + [12 / Object.keys(links).length]">
                    <h6>{{ index }}</h6>
                    <ul>
                        <li class="small" v-for="practice in city">
                            <a href="#" @click="onClick(index, practice)">{{ practice }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
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
            window.axios.get('/links').then((response) => {
                this.links = response.data;
            });
        },
        methods: {
            onClick(city, practice) {
                this.setCity(city);
                this.setPractice(practice);
                this.search(city, practice)
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
            },
            setPractice(practice) {
                this.practice = practice;
            },
            search(city, practice) {
                let params = {
                    city,
                    practice,
                    searchType: 'search_by_city_and_practice'
                };
                window.axios.post('/search', params).then((response) => {
                    this.doctors = response.data;
                });
            }
        }
    }
</script>
