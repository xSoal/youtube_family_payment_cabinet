<template>
    <div class="createCont">
        <div
            class="addUser__button"
            @click="userAddClick"
        >
            <v-icon scale="1.2" name="user-plus"  />
            <span class="addUser__text">Добавить пользователя</span>
        </div>

        <div class="addUser__body"
             :class="{open : isUserAddOpen}"
        >
            <div class="inputsCont">
                <div class="inputCont">
                    <Input
                        v-model="addUserData.email"
                        type="email"
                        title="Почта"
                        reqired="true"
                    />
                </div>
                <div class="inputCont">
                    <Input
                        v-model="addUserData.name"
                        type="text"
                        title="Имя"
                        reqired="true"
                    />
                </div>
                <div class="inputCont">
                    <Input
                        v-model="addUserData.password"
                        type="password"
                        title="Пароль"
                        reqired="true"
                    />
                </div>
                <div class="inputCont">
                    <Input
                        v-model="addUserData.password_confirm"
                        type="password_confirm"
                        title="Подтверждение"
                        reqired="true"
                    />
                </div>
                <div class="buttonCont">
                    <button class="button"
                    @click="addUserHandler"
                    >submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Input from "../../units/Input";
import {mapActions} from "vuex";
export default {
    name: "CreateUser",
    components: {
        Input
    },
    data(){
        return {
            isUserAddOpen: false,
            addUserData: {
                email: '',
                name: '',
                password: '',
                password_confirm: ''
            },

        }
    },
    methods: {
        ...mapActions([
            'createUser'
        ]),
        userAddClick(){
            this.isUserAddOpen = !this.isUserAddOpen;
        },
        async addUserHandler(){

            const res = await this.createUser({...this.addUserData});
            if( !res.error ){
                this.isUserAddOpen = false;
            }
        }
    }
}
</script>

<style scoped>
    .createCont {

    }

    .addUser__button {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        cursor: pointer;
        user-select: none;
    }

    .addUser__text {
        margin-left: 5px;
    }

    .addUser__body {
        display: none;
    }

    .addUser__body.open {
        display: block;
    }

    .buttonCont {
        margin-top: 24px;
    }
</style>
