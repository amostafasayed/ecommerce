require('./bootstrap');
window.Vue = require('vue');
import VeeValidate from 'vee-validate'
import vSelect from 'vue-select'

Vue.use(VeeValidate)
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('auction-slots', require('./components/auction-slots.vue').default);
Vue.component('auction-slots-single', require('./components/single-auction-slots.vue').default);
Vue.component('v-select', vSelect);
import moment from 'moment';
import VueCarousel from 'vue-carousel';

Vue.use(VueCarousel);
Vue.prototype.moment = moment
const app = new Vue({
    el: '#app',
    data() {
        return {
            message: 'This message from vue',
            form: {},
            regularHeader: true,
            serverTime: window.serverTime,
            user:{},
            termCheck:false,
        }
    },
    created() {
        this.setAuth()

    },

    mounted() {

    },

    methods: {
        setAuth(){
            var authData=window.auth.replace(/&quot;/g,'\"')
            if(authData){this.user=JSON.parse(authData)}
        },

        placeBid(){
          alert('Place Bid under construction')
        },
        changeTerm(){
            this.termCheck =!this.termCheck
        },

        countDown(id, upTime){
            this.$nextTick(()=>{
                $("#getting-started"+id).countdown(upTime, function (event) {
                    $(this).text(
                        event.strftime('%D days %H:%M:%S')
                    );
                });
            })

        }
    },

});
