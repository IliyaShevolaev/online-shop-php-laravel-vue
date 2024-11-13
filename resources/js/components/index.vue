<template>
    <div>
        <Navbar></Navbar>
    </div>
</template>
<script>
import Profile from './pages/Profile.vue';
import Navbar from './ui_elements/Navbar.vue';

export default {
    components: {
        Navbar,
        Profile
    }, 

    data() {
        return {
            
        }
    },
}
</script>
<style>
    
</style>