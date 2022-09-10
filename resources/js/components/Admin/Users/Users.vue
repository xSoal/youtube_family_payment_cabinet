<template>
    <div>
        <CreateUser />

        <div class="usersList">
            <UserItem
                v-for="user in users"
                :key="user.id"
                :name="user.name"
                :email="user.email"
                :id="user.id"
                :isOpen="openUserId === user.id"
                @userSelected="userSelectedHandler"
                @closeAllUsers="openUserId = null"
            />
        </div>

    </div>
</template>

<script>

import CreateUser from "./CreateUser";
import { mapActions } from 'vuex';
import { mapState } from "vuex";
import UserItem from "./UserItem";

export default {
    name: "Users",
    components: {
        CreateUser, UserItem
    },
    data(){
        return {
            openUserId: -1
        }
    },

    methods: {
        ...mapActions([
            "getAllUsers"
        ]),

        userAddClick(){
            this.isUserAddOpen = !this.isUserAddOpen;
        },

        userSelectedHandler(userId){
            if(userId === this.openUserId){
                this.openUserId = -1;
                return
            };
            this.openUserId = userId;
        }

    },

    computed: {
        ...mapState(['users']),
    },

    mounted(){
        this.getAllUsers();
    }
}
</script>

<style scoped>

</style>
