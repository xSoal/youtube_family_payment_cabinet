<template>
    <div class="cont">
        <h2>Добавить периоды</h2>
        <div>
            {{userId}}
        </div>
        <div>
            <div
                :style="{ 'opacity' : startPeriodsData ? 1 : 0   }"
            >
                <label >
                    <p>from: </p>
                    <input type="month" :min="localStartPeriodData" v-model="localStartPeriodData">
                </label>
                <label >
                    <p>to: </p>
                    <input type="month" v-model="endPeriodsData">
                </label>
                <label >
                    <p>user count: </p>
                    <input type="number" min="1" v-model="userInPaymentCount">
                </label>
                <label >
                    <button @click="sendHandler" class="button"> расчитать </button>
                </label>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";

export default {
    name: "UserPeriods",
    props: ['userId'],
    data(){
        return {
            localStartPeriodData: '',
            endPeriodsData: '',
            userInPaymentCount: 1,
        }
    },
    computed: {
        ...mapState([
            'startPeriodsData'
        ]),

    },
    methods: {
        ...mapActions([
            'getStartPeriodData',
            'createUserPeriods'
        ]),

        sendHandler(){
            this.createUserPeriods({
                userId: this.userId,
                startFrom: this.localStartPeriodData,
                startTo: this.endPeriodsData,
                userInPaymentCount: this.userInPaymentCount
            });
        }
    },
    mounted() {
        if(!this.startPeriodsData){
            this.getStartPeriodData();
        } else {
            this.localStartPeriodData = this.startPeriodsData;
        }
    },

    watch: {
        startPeriodsData(newData){
            this.localStartPeriodData = newData;
        }
    }
}
</script>

<style scoped>
    .cont {
        margin: 15px;
        padding: 0 15px;
    }
</style>
