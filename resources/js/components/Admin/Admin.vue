<template>
    <div class="adminCont">
        <GlobalLoader />
        <LeftMenu />
        <div class="admin__body">
            <keep-alive>
                <router-view v-if="$route.meta.keepAlive"></router-view>
            </keep-alive>
            <router-view v-if="!$route.meta.keepAlive"></router-view>
        </div>
        <Footer/>
    </div>
</template>

<script>
import LeftMenu from "./LeftMenu";
import Footer from "./Footer";
import GlobalLoader from './GlobalLoader';

export default {
    name: "Admin",
    components: {
        LeftMenu,
        Footer,
        GlobalLoader
    }
}
</script>

<style scoped>

.adminCont {
    min-height: 100vh;
    background-color: #fdcd42;
    display: flex;
    flex-direction: column;
    justify-content: center;
}


.admin__body {
    margin-left: 100px;
    padding: 10px 25px;
}

</style>
