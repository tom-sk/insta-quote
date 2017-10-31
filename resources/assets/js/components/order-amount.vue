<template>
    <div class="">
        Amount: {{ order.amount }}
        <br >

        <strike>{{ discountCost }}</strike>
        £{{ cost }}
    
        <br >
        {{ discount }}
        <vue-slider 
            ref="slider" 
            v-model="order.amount" 
            :min='100' 
            :max='500'
            :data='["100","200","300","400","500"]'
            :piecewise='true'
            :piecewiseLabel='true'
            :piecewiseStyle='{
                "backgroundColor": "#ccc",
                "visibility": "visible",
                "width": "12px",
                "height": "12px",
                "cursor": "pointer"
            }'
            :piecewiseActiveStyle='{
                "backgroundColor": "#3498db",
                "cursor": "pointer"
            }'
            :tooltip="false"
            :labelActiveStyle='{
                "color": "#3498db"
            }'>
        </vue-slider>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },
    data(){
        return {
            order: {
                amount : ''
            },

        }
    },
    computed: {
        cost(){
            if(this.order.amount == 100) {
                return (this.order.amount / 20);
            } else if (this.order.amount == 200) {
                return (this.order.amount * 0.8) / 20;
            }  else if (this.order.amount == 300 || this.order.amount == 400 || this.order.amount == 500) {
                return Math.floor((this.order.amount * 0.75) / 20);
            }
           
        },
        discountCost(){
            if(this.order.amount != 100) 
                return '£' + this.order.amount / 20;
        },
        discount(){
            if(this.order.amount == 100) {
                return 'No Discount';
            } else if (this.order.amount == 200) {
                return '20%';
            }  else if (this.order.amount == 300 || this.order.amount == 400 || this.order.amount == 500) {
                return '25%';
            }
        }
    }
}
</script>
            