<template>
    <div>
        <h1>Index</h1>
        <router-link to="/shop">SHOP</router-link>
        <router-view></router-view>
        <PrimaryNew></PrimaryNew>
    </div>
</template>
<script>
import PrimaryNew from './PrimaryNew.vue';

export default {
    components: {
        PrimaryNew
    }, 

    data() {
        return {
            
        }
    },
}
</script>
<style>
    
</style>