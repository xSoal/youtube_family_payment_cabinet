<template>
    <div>
        <div>
            
            <p>Периоды</p>
            <div class="periods__cont">
                <YoutubePeriodVue
                    v-for="per in youtubePeriods"
                    :period="per"
                    :key="per.id"
                />
            </div>
        </div>

        <br><br><br>
        <div>
            <div>
                <p>Add Period</p> {{ localDateYearMonth }} qwe asd
                <label >
                    <input v-model="localDateYearMonth" type="month" >
                </label>
                <label>
                    <input type="number" v-model="localYoutubeDefaultAmount">
                </label>
                <label >
                    <button @click="addHandler" class="button"> add </button>
                </label>
            </div>
        </div>
    </div>
    
</template>

<script>
    import { mapActions } from 'vuex';
    import { mapState } from "vuex";
    import { getDateYearMonth } from '@/helpers';
    import YoutubePeriodVue from './YoutubePeriod.vue';

    export default {
        components: {
            YoutubePeriodVue
        },
        data: function() {
            return {
                localDateYearMonth: null,
                localYoutubeDefaultAmount: null
            }
        },
        computed: {
            ...mapState([
                'youtubePeriods',
                'youtubeDefaultAmount'
            ])
        },
        methods: {
            ...mapActions([
                'getYoutubePeriods',
                'addYoutubePeriod'
            ]),
            addHandler(e){
                this.addYoutubePeriod({
                    yearMonthDate: this.localDateYearMonth,
                    amount: this.localYoutubeDefaultAmount
                });
            }
        },
        
        mounted: function(){
            this.getYoutubePeriods();
            this.localDateYearMonth = getDateYearMonth();
            this.localYoutubeDefaultAmount = this.youtubeDefaultAmount;
        },

    }
</script>

<style lang="scss" scoped>
    .periods__cont {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        flex-wrap: wrap;
    }
</style>