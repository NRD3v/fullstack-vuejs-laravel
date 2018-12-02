<template>
    <div v-if="doctor" class="col-6">
        <div class="row" style="border: 1px solid #dbe0e0; border-radius: 2px;">
            <div class="col-4 align-middle" style="vertical-align: middle">
                <img src="../../images/Photo.jpg" width="75" style="border-radius: 2px">
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
</template>

<script>
    export default {
        props: ['doctor']
    }
</script>
