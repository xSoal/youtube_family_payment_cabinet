<template>
    <div class="cont">
        <div>period userName: {{userName}}</div>
        <div>
            {{paymentData}}
        </div>
        <div
            class="delete"
            @click="deleteHandler"
        >
            <span class="deleteIcon">x</span>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "PaymentPeriod",
    props: [
        'paymentData', 'userName'
    ],
    computed: {

    },
    methods: {
        ...mapActions([
            'deleteUserPayment'
        ]),
        deleteHandler(){
            this.deleteUserPayment(this.paymentData.id);
        }

    },

}
</script>

<style scoped>
    .cont {
        padding: 15px;
        background-color: #e7e7e7;
        max-width: 250px;
        position: relative;
    }

    .delete {
        position: absolute;
        top: 5px;
        right: 5px;
        border-radius: 50%;
        border: 1px solid;
        width: 25px;
        height: 25px;
        font-size: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .deleteIcon {
        transform: translateY(-1px);
    }
</style>
