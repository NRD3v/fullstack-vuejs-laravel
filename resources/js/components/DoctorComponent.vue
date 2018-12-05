<template>
    <div v-if="doctor" class="col-6 p20">
        <div class="row doctor-container min-h130">
            <div class="col-4 align-middle p10">
                <img src="../../images/Photo.jpg" class="imageRadius2" width="120">
            </div>
            <div class="col-8">
                <div class="h120 p10">
                    <h5>{{ doctor.name }}</h5>
                    <h6 class="grey">{{ doctor.city }}</h6>
                    <p class="small">
                        <span v-for="(practice, index) in doctor.practice">
                            <span>{{ practice }}</span><span v-if="index + 1 < doctor.practice.length">, </span>
                        </span>
                    </p>
                    <p class="small font-weight-bold text-primary">Prendre un RDV</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['doctor']
    }
</script>

<style scoped>
    .doctor-container {
        border: 1px solid #dbe0e0;
        border-radius: 2px;
    }
    .grey {
        color: #C6C6C6;
    }
    .imageRadius2 {
        border-radius: 2px
    }
</style>
