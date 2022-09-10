<template>
    <div>
        <div>AllPayments</div>
        <div class="paymentsCont">
            <PaymentPeriod
                class="paymentCont"
                v-for="payment in allPayment"
                :key = "payment.id"
                :paymentData = "payment"
                :userName = "getUserName(payment.user_id)"

            />
        </div>
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";
import PaymentPeriod from "./PaymentPeriod";

export default {
    name: "AllPayments",
    components: {
        PaymentPeriod
    },

    computed: {
        ...mapState([
            'allPayment',
            'users'
        ]),
    },
    methods: {
        ...mapActions([
            'getAllPayments',
            'getAllUsers'
        ]),

        getUserName(userId){
            return this.users.find(el => el.id === userId)?.name ?? 'deleted user' ;
        }
    },
    mounted() {
        this.getAllPayments();

        if(!this.users){
            this.getAllUsers()
        }
    }
}
</script>

<style scoped>

    .paymentsCont {
        display: flex;
        justify-content: flex-start;
        margin-left: -10px;
        margin-right: -10px;
    }

    .paymentCont {
        margin: 10px;
    }

</style>
