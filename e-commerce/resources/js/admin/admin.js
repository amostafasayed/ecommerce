require('./bootstrap');

window.Vue = require('vue');

import VeeValidate from 'vee-validate'
import vSelect from 'vue-select'

Vue.use(VeeValidate)
Vue.component('v-select', vSelect);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
    data() {
        return {
            form: {},
            name: '',
            status:'Active',
            statusShow:true,
            count: 0,
            slotRangeData: [
                {slot_number: '', slotRange: ''}
            ],

        }
    },
    methods: {
        deleteMe(url) {
            if (confirm('Are you sure?')) {
                $('#deleteForm').attr('action', url).submit();
            }
        },
        addRow() {
            this.slotRangeData.push({slot_number: '', slotRange: ''})

        },
        removeRow() {
            this.slotRangeData.pop()
        },

        getSlotRage(val, index) {

            if (index == 0) {
                this.slotRangeData[index].slotRange = 0 + '-' + this.slotRangeData[index].slot_number
            } else {
                this.slotRangeData[index].slotRange = this.slotRangeData[index - 1].slot_number + '-' +
                    this.slotRangeData[index].slot_number
            }

        },
        getSlotDurationDate(index) {
            $('#slotDuration' + index).datetimepicker({
                datepicker: false,
                format: 'H:i:s',
                step: 5,
            });
        },
        setStatus(val){
            this.status=val
            this.statusShow=false
        },
        initialSlotRange(ranges) {
            if(this.count === 0){
                var ranges = JSON.parse(ranges)

                ranges.forEach((range, index) => {
                    if(index > 0) {
                        this.addRow()
                    }
                    this.slotRangeData[index].slot_number = range.slot_number
                    this.getSlotRage(range.slot_number, index)
                    Vue.nextTick(() => {
                        $('#slotDuration' + index).val(range.duration_time);
                    })
                })
                this.count++
            }

        }

    }


});
