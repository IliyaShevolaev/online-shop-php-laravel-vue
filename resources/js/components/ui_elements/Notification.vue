<template>
    <div v-if="visible" class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div :class="`alert ${alertType} alert-dismissible fade show`" role="alert">
            <strong>{{ alertMessage }}</strong>
            <button type="button" class="btn-close" @click="closeNotification" aria-label="Close"></button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            visible: false,
            alertType: "alert-success", 
            alertMessage: null,
        };
    },
    methods: {
        closeNotification() {
            this.visible = false;
        },
        showNotification(type, message) {
            this.alertType = type;
            this.alertMessage = message;
            this.visible = true;

            setTimeout(() => {
                this.closeNotification();
            }, 3000);
        },
    },
};
</script>

<style scoped>
</style>