<template>
    <div>
        <h1>Cart</h1>
    </div>
</template>
<script>
export default {
    mounted() {
        console.log(JSON.parse(localStorage.getItem('cart')));
    },
}
</script>
<style>
    
</style>