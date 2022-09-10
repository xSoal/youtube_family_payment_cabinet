<template>
    <div class="">
        <div
            class="userHeader"
            @click="onHeaderClickHandler"
        >
            {{ name }}
            <div class="header__deleteButton"
                @click.stop="deleteUserHandler"
            >
                <v-icon name="ban"></v-icon>
            </div>
        </div>
        <div class="userBody"
             :class="{ open: isOpen }"
        >
            <div v-if="isOpen">
                <div class="tabsHeader">
                    <div class="tabsHeader__element"
                         v-for="tab in tabsData.tabsHeaders"
                         :key="tab.id"
                         :class="{'isActive' : tabsData.currentTab === tab.id}"
                         @click="tabsData.currentTab = tab.id"
                    >
                        {{tab.name}}
                    </div>
                </div>
                <UserPeriods
                    v-show="tabsData.currentTab === 0"
                    :userId="id" />

                <div
                    v-show="tabsData.currentTab === 1"
                    class="userInputs"
                >
                    <Input
                        v-model="localName"
                        title="Имя"
                        type="text"
                        :error="errors.name"
                    />

                    <Input
                        v-model="localEmail"
                        title="Почта"
                        type="email"
                        :error="errors.email"
                    />
                    <Input
                        v-model="password"
                        title="Password"
                        type="email"
                        :error="errors.password"
                    />

                    <Input
                        v-model="password_confirm"
                        title="Password Confirm"
                        type="email"
                        :error="errors.password_confirm"
                    />

                    <div class="userItem__save">
                        <button class="button"
                                @click="editUserHandler"
                        >save</button>
                    </div>
                </div>

                <UserEditPeriods
                    v-show="tabsData.currentTab === 2"
                    :userId="id"
                />
            </div>

        </div>

    </div>
</template>

<script>
import Input from "../../units/Input";
import {mapActions} from "vuex";
import { notification } from 'ant-design-vue';
import UserPeriods from "./UserPeriods";
import UserEditPeriods from "./UserEditPeriods";

export default {
    name: "UserItem",
    props: ["id", "email", "name", "isOpen"],
    // props: ["data", "isOpen"],
    components: {
        Input, UserPeriods, UserEditPeriods
    },
    data() {
        return {
            localEmail: this.email,
            localName: this.name,
            password: '',
            password_confirm: '',
            errors: {
                name: '',
                email: '',
                password: '',
                password_confirm: ''
            },

            tabsData: {
                tabsHeaders: [
                    {
                        id: 0,
                        name: "Добавить периоды",

                    },
                    {
                        id: 1,
                        name: "Данные пользователя",
                    },
                    {
                        id: 2,
                        name: "Редактировать периоды",
                    }
                ],
                currentTab: 0
            }
        }
    },

    computed: {},

    methods: {
        ...mapActions([
            'editUser',
            'deleteUser'
        ]),
        onHeaderClickHandler() {
            this.$emit('userSelected', this.id)
        },
        async editUserHandler() {
            this.errors = {
                name: '',
                email: '',
                password: '',
                password_confirm: ''
            }

            if(this.password && this.password !== this.password_confirm){
                this.errors.password_confirm = 'Не совпадает пароль';
            }

            if(!this.email){
                this.errors.email = 'Пусто'
            }

            if(!this.name){
                this.errors.name = 'Пусто'
            }

            if(
                // !this.errors.name &&
                // !this.errors.email &&
                // !this.errors.password &&
                // !this.errors.password_confirm
                Object.values(this.errors).every( el => el === '')
            ){

                const res = await this.editUser({
                    id: this.id,
                    email: this.localEmail,
                    name: this.localName,
                    password: this.password,
                    password_confirm: this.password_confirm,
                });

                if(!res.error){
                    this.$emit('closeAllUsers');
                    return
                }

                this.errors = {
                    ...res.errors
                }



            }




        },

        deleteUserHandler(){
            if(confirm('Удалить учетку?')){
                this.deleteUser({
                    id: this.id
                })
            }
        }

    }
}
</script>

<style>


.tabsHeader {
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.tabsHeader__element {
    margin: 35px;
    cursor: pointer;
}

.tabsHeader__element.isActive {
    border: 1px solid;
}

.userHeader {
    padding: 15px 25px;
    position: relative;
}

.userInputs > div {
    margin: 10px;
}

.userBody {
    height: 0;
    padding-top: 10px;
    overflow: hidden;
    opacity: 0;
    transform: translate(-45px, 0);
    transition: all .325s;
    transition-timing-function: ease-in;
}

.userBody.open {
    transform: translate(0, 0);
    opacity: 1;
    height: 540px;
}

.userInputs {
    flex-wrap: wrap;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.userItem__save {
    width: 100%;
    text-align: center;
}

.header__deleteButton {
    position: absolute;
    top: 0;
    bottom: 0;
    right: 15px;
    padding: 10px;
    cursor: pointer;
}


</style>
