<template>
    <div>
        <div>user periods</div>
        <div>{{currentUserPeriods}}</div>
    </div>

</template>

<script>
import {mapActions, mapState} from "vuex";

export default {
    name: "UserEditPeriods",
    props: ['userId'],
    computed: {
        ...mapState(['currentUserPeriods']),
    },
    methods: {
        ...mapActions(['getUserPeriods'])
    },
    mounted(){
        this.getUserPeriods(this.userId);
        console.log('im mounted')
    }
}
</script>

<style scoped>

</style>
