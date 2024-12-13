<template>
    
</template>
<script>
import axios from 'axios';


export default {
    mounted() {
        this.getCart();
    },

    methods: {
        getCart() {
            axios.get('/api/products/cart/index')
                .then(res => {
                    console.log(res);
                })
        }
    },
}
</script>
<style></style>