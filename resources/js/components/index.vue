<template>
    <div>
        <Navbar></Navbar>

        <div class="content">
            <router-view></router-view>
        </div>

    </div>
</template>
<script>
import Navbar from './ui_elements/Navbar.vue';

export default {
    components: {
        Navbar,
    }, 

    data() {
        return {
            
        }
    },
}
</script>
<style scoped>
    .content {
    margin-top: 120px;
}

</style>