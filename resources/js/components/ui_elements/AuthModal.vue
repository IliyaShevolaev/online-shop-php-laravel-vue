<template>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Log In</h5>
                <button type="button" class="btn-close" @click="closeModal"><i class="bi bi-x-circle"></i></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="login">
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" v-model="email"
                            placeholder="Enter your email" required />
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" v-model="password"
                            placeholder="Enter your password" required />
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    emits: ['close'],
    data() {
        return {
            email: '',
            password: ''
        };
    },
    methods: {
        closeModal() {
            this.$emit('close');
        },

        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    'email': this.email,
                    'password': this.password,
                }).then(response => {
                    this.closeModal();
                });
            });
        },
    }
};
</script>

<style scoped>
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1050;
}

.modal-dialog {
    background-color: white;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    padding: 20px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: none;
}

.modal-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #004c99;
}

.btn-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #004c99;
    cursor: pointer;
}

.modal-body {
    margin-top: 1rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-label {
    font-size: 1rem;
    font-weight: 500;
}

.form-control {
    border-radius: 5px;
    padding: 0.75rem;
    font-size: 1rem;
}

.btn {
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    border-radius: 5px;
}
</style>
