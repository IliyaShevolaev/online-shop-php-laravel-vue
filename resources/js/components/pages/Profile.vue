<template>
    <div v-if="user" class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm text-center p-4">
                    <!-- <img :src="user.avatar || '/default-avatar.png'" class="rounded-circle avatar-img" alt="Avatar"> -->
                    <h4>{{ userProfileView.name }}</h4>
                    <h4>{{ userProfileView.surname }}</h4>
                    <p class="text-muted">{{ userProfileView.email }}</p>
                    <button class="btn btn-outline-primary w-100" @click.prevent="goToOrders">
                        <i class="bi bi-box-seam"></i> My Orders </button>
                    <button class="btn btn-outline-danger w-100 mt-2" @click.prevent="logout">
                        <i class="bi bi-box-arrow-in-right"></i> Log out </button>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm p-4">
                    <h5 class="mb-3">Profile Information</h5>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input v-model="user.email" type="email" class="form-control" disabled />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input v-model="user.name" type="text" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Surname</label>
                        <input v-model="user.surname" type="text" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input v-model="user.address" type="text" class="form-control" />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select v-model="user.gender" class="form-select">
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Not specified</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Age</label>
                            <input v-model="user.age" type="number" class="form-control" min="0" max="120" />
                        </div>
                    </div>

                    <div v-if="profileInfoCheck" class="alert alert-warning mt-3 d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div>Please fill in all your profile information.</div>
                    </div>

                    <button @click.prevent="editData" type="button" class="btn btn-primary w-100 fw-bold mt-3">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div v-else>
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <Notification ref="notification"></Notification>
</template>

<script>
import axios from "axios";
import Notification from "../ui_elements/Notification.vue";

export default {
    data() {
        return {
            user: null,
            userProfileView: null,

            fullProfile: true,
        };
    },

    components: {
        Notification
    },

    mounted() {
        this.getUserInfo();
    },

    computed: {
        profileInfoCheck() {
            return this.user && (!this.user.age || !this.user.address);
        }
    },

    methods: {
        getUserInfo() {
            axios.get("/api/profile/")
                .then((res) => {
                    this.user = res.data.data;
                    this.userProfileView = JSON.parse(JSON.stringify(this.user));
                });
        },

        editData() {
            axios.post('/api/profile/edit', {
                name: this.user.name,
                surname: this.user.surname,
                gender: this.user.gender,
                age: this.user.age,
                address: this.user.address,
            }).then(res => {
                this.getUserInfo();
                this.notify('alert-success', 'New profile info saved');
            })
        },

        getGenderTitle(gender) {
            if (gender === 1) {
                return 'Male';
            }

            if (gender === 2) {
                return 'Female';
            }

            return 'Not specified';
        },

        logout() {
            axios.post("/logout").then(() => {
                localStorage.removeItem("auth");
                this.$router.push({ name: "page.main" });
            });
        },

        notify(type, message) {
            this.$refs.notification.showNotification(type, message);
        },
    },
};
</script>

<style scoped>
.avatar-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 4px solid #0d6efd;
}

.card {
    border-radius: 12px;
}

.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.btn-primary:hover {
    background-color: #0b5ed7;
}

.btn-outline-primary {
    border-color: #0d6efd;
}

.btn-outline-primary:hover {
    background-color: #0d6efd;
    color: white;
}
</style>