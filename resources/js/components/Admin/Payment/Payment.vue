<template>
    <div>
        <div class="tabsHeader">
            <div class="tabsHeader__element"
                v-for="t in tabsData.tabs"
                :id = "t.id"
                 @click = "tabsData.currentTab = t.id"
                 :class="{'isActive' : tabsData.currentTab === t.id}"
            > {{ t.name }}</div>
        </div>
        <div class="tabs__body">
            {{ getTabComponentName }}
            <component
                :is="getTabComponentName"
            />
        </div>
    </div>
</template>

<script>
import CreateUserPayment from "./CreateUserPayment";
import AllPayments from "./AllPayments";

export default {
    name: "Payment",
    components: {
        CreateUserPayment, AllPayments
    },
    data(){
        return {
            tabsData: {
                currentTab: 0,
                tabs: [
                    {
                        id: 0,
                        name: "Создать оплату",
                        componentName: "CreateUserPayment"
                    },
                    {
                        id: 1,
                        name: "Все оплаты",
                        componentName: "AllPayments"
                    }
                ]
            }
        }
    },

    computed: {
        getTabComponentName(){
            return this.tabsData.tabs.find(t => t.id === this.tabsData.currentTab).componentName
        }
    }
}
</script>

<style scoped>
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

</style>
