<template>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ this.modalName }}</h5>
                <button type="button" class="btn-close" @click="closeModal"><i class="bi bi-x-circle"></i></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="login">
                    <div v-if="registerMode" class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" v-model="name" placeholder="Enter your name"
                            required />
                    </div>

                    <div v-if="registerMode" class="form-group mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" id="surname" class="form-control" v-model="surname"
                            placeholder="Enter your surname" required />
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" v-model="email"
                            placeholder="Enter your email" required />
                    </div>

                    <div class="form-group mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-wrapper">
                            <input :type="hidePassword ? 'password' : 'text'" id="password" class="form-control"
                                v-model="password" placeholder="Enter your password" required />
                            <i class="bi bi-eye-fill toggle-password" @click="changeViewPasswordMode"></i>
                        </div>
                    </div>

                    <div v-if="registerMode" class="form-group mb-3 position-relative">
                        <label for="password_confirm" class="form-label">Password</label>
                        <div class="input-wrapper">
                            <input :type="hidePassword ? 'password' : 'text'" id="password_confirm" class="form-control"
                                v-model="password_confirm" placeholder="Confirm your password" required />
                            <i class="bi bi-eye-fill toggle-password" @click="changeViewPasswordMode"></i>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mb-2">{{ this.modalName }}</button>
                        <div class="register-link">
                            <p>
                                {{ this.changeModeText }}
                                <a href="#" @click.prevent="changeMode">{{ this.changeButtonText }}</a>
                            </p>
                        </div>
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
            registerMode: false,
            modalName: 'Log in',
            changeModeText: 'Don\'t have an account?',
            changeButtonText: 'Register',

            hidePassword: true,

            name: '',
            surname: '',
            email: '',
            password: '',
            password_confirm: '',
        };
    },
    methods: {
        closeModal() {
            this.$emit('close');
        },

        changeMode() {
            if (this.registerMode) {
                this.modalName = 'Log in';
                this.changeModeText = 'Don\'t have an account?';
                this.changeButtonText = 'Register';
            } else {
                this.modalName = 'Register';
                this.changeModeText = 'Already have an account?';
                this.changeButtonText = 'Log in';
            }

            this.registerMode = !this.registerMode;
        },

        changeViewPasswordMode() {
            this.hidePassword = !this.hidePassword;
        },

        login() {
            let userData = {};
            let authPath = '';

            if (this.registerMode) {
                userData = {
                    name: this.name,
                    surname: this.surname,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirm,
                };

                authPath = '/register';
            } else {
                userData = {
                    email: this.email,
                    password: this.password,
                };

                authPath = '/login';
            }

            axios.get('/sanctum/csrf-cookie').then(() => {
                axios.post(authPath, userData)
                    .then(() => {
                        localStorage.setItem('auth', 'true');
                        this.closeModal();
                        this.$router.push({ name: 'page.profile' });
                    });
            });
        },
    }
};
</script>

<style scoped>
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

.register-link p {
    margin: 0;
    font-size: 0.9rem;
}

.register-link a {
    color: #004c99;
    font-weight: bold;
    text-decoration: none;
    cursor: pointer;
}

.register-link a:hover {
    text-decoration: underline;
}

.btn {
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    font-weight: bold;
    color: white;
    background: linear-gradient(135deg, #004c99, #0066cc);
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn:hover {
    background: linear-gradient(135deg, #0066cc, #004c99);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

.btn:active {
    transform: translateY(0);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.position-relative {
    position: relative;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.toggle-password {
    position: absolute;
    right: 10px;
    cursor: pointer;
    font-size: 1.2rem;
    color: #666;
    transition: color 0.3s ease;
}

.toggle-password:hover {
    color: #004c99;
}
</style>
