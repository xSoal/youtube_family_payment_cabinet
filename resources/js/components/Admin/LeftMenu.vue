<template>
    <div class="cont">
        <div class="linksCont">
            <router-link v-for="(i,key) in leftMenuRoutes"
                         class="item"
                         :to="i.path"
                         :key="key"
            >
                {{ i.name }}
            </router-link>
        </div>
        <div class="rebaseCont" >
            <div class="rebase" @click="rebasePeriodsHandler">
                rebase
            </div>
        </div>
    </div>
</template>

<script>

import {leftMenuRoutes} from './eco/router';
import {mapActions} from "vuex";

export default {
    name: "LeftMenu",
    data() {
        return {
            leftMenuRoutes
        }
    },

    methods: {

        ...mapActions([
            'rebasePeriods'
        ]),

        rebasePeriodsHandler(){
            this.rebasePeriods();
        }
    }
}
</script>

<style scoped>


.linksCont {
    flex: 1;
}

.cont {
    width: 100px;
    height: 100vh;
    background-color: #8D8FD8;
    position: fixed;
    top: 0;
    left: 0;
    padding: 10px 15px;

    display: flex;
    flex-direction: column;
}


.rebaseCont {
    text-align: center;
    border: 1px solid;
    border-radius: 5px;

    padding: 5px 15px;
    margin-bottom: 45px;

    cursor: pointer;
}

.item {
    display: block;
    text-align: center;
    font-size: .9rem;
    text-decoration: none;
    color: white;
}


</style>
