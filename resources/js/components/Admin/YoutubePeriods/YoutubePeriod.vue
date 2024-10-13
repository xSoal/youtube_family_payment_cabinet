<template>
    <div class="period">
        {{ period  }}
        <span class="deleteItem" @click="deleteHandler">
            <div class="deleteItem_circle"></div>
            <div class="deleteItem_stem"></div>
            <div class="deleteItem_stem2"></div>
        </span>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'; 
    export default {
        props: [
            'period'
        ],

        data(){
            return {
                id: this.period.id
            }
        },

        methods: {
            ...mapActions([
                'deleteYoutubePeriod'
            ]),
            deleteHandler(){
                this.deleteYoutubePeriod(this.period.id);
            }
        }

    }
</script>

<style lang="scss" scoped>
    .period {
        padding: 25px 25px;
        position: relative;
        margin: 5px;
    }
     .deleteItem {
        display: inline-block;
        width: 22px;
        height: 22px;
        position: relative;
        transform: rotate(45deg);
        position: absolute;
        top: 0px;
        right: 0px;
        cursor: pointer;
    }

    .deleteItem_circle {
        position: absolute;
        width: 22px;
        height: 22px;
        background-color: orange;
        border-radius: 11px;
        left: 0;
        top: 0;
    }

    .deleteItem_stem,
    .deleteItem_stem2 {
        position: absolute;
        background-color: #fff;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .deleteItem_stem {
        width: 3px;
        height: 9px;
    }

    .deleteItem_stem2 {
        width: 9px;
        height: 3px;
    }
</style>