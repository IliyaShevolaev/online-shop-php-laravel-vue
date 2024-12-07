<template>
    <CardsList productsPath="favorites/index"></CardsList>
</template>

<script>
import CardsList from '../product/CardsList.vue';
import Notification from '../ui_elements/Notification.vue';

export default {
    components: {
        CardsList,
        
    }
};
</script>

<style scoped>

</style>