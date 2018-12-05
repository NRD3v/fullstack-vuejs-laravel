<template>
    <div v-if="doctor" class="col-6 p10">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <img src="../../images/Photo.jpg" class="imageRadius2" width="100">
                    </div>
                    <div class="col-8 card-text h-50 maxh50">
                        <span>{{ doctor.name }}</span>
                        <br>
                        <span class="grey">{{ doctor.city }}</span>
                        <br>
                        <span class="small">
                            <span v-for="(practice, index) in doctor.practice">
                                <span>{{ practice }}</span><span v-if="index + 1 < doctor.practice.length">, </span>
                            </span>
                        </span>
                        <br>
                        <span class="small font-weight-bold text-primary">Prendre un RDV</span>
                    </div>
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
