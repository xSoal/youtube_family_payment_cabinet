<template>
    <div>
        <div>create payment header</div>
        <div>
            <div>
                <div>
                    <p>user</p>
                    <select
                        v-model="selectedUserId"
                        :class="{'hasError' : errors.userId !== ''}"
                    >
                        <option v-for="user in users"
                                :id="user.id"
                                :key="user.id"
                                :value="user.id"
                        >{{ user.name }}
                        </option>
                    </select>
                </div>
                <br>
                <div>
                    <Input
                        v-model="amount"
                        title="Сумма"
                        type="number"
                        :error="errors.amount"
                    />
                </div>
                <div>
                    <Input
                        v-model="date"
                        title="Дата"
                        type="date"
                        :error="errors.amount"
                    />
                </div>
            </div>

            <div>
                <button @click="addPaymentHandler" class="button" type="text">Добавить</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";
import Input from "../../units/Input";
import getCurrentData from "../../helpers";

export default {
    name: "CreateUserPayment",
    components: {
        Input
    },
    data() {
        return {
            selectedUserId: null,
            amount: 50,
            date: getCurrentData(),
            errors: {
                amount: "",
                userId: "",
                date: "",
            }
        }
    },
    computed: {
        ...mapState([
            'users'
        ])
    },

    methods: {
        ...mapActions([
            'getAllUsers',
            'addUserPayment'
        ]),
        addPaymentHandler() {
            this.errors = {
                amount: "",
                userId: "",
                date: "",
            }

            if (!this.selectedUserId) {
                this.errors.userId = 'required';
                return;
            }

            if(!this.amount){
                this.errors.amount = 'required';
                return;
            }

            if(!this.date){
                this.errors.date = 'required';
                return;
            }

            this.addUserPayment({
                userId: this.selectedUserId,
                amount: this.amount,
                date: this.date
            });
        }
    },

    mounted() {
        this.getAllUsers();
    },

    watch: {
        users(newVal) {

        }
    }
}
</script>

<style scoped>

    .hasError {
        border: 1px solid red;
    }

</style>
