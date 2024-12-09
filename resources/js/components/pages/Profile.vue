<template>

    <div class="profile-container d-flex flex-column align-items-center text-center mt-5">
        <div class="alert alert-warning mt-4" v-if="!user || !user.orderInfoComplete">
            Please complete all order details to proceed.
        </div>

        <div v-if="user" class="user-info mt-5">
            <h1 class="mb-4">Welcome, {{ user.name }} {{ user.surname }}!</h1>
            <div class="info-card shadow-sm p-4 mb-4 bg-white rounded">
                <p><strong>Email:</strong> {{ user.email }}</p>
                <p><strong>Age:</strong> <span :class="{ 'text-danger': !user.age }">{{ user.age || 'Not specified'
                        }}</span></p>
                <p><strong>Address:</strong> <span :class="{ 'text-danger': !user.age }">{{ user.age || 'Not specified'
                        }}</span></p>
            </div>
            <button class="btn btn-primary mt-3" @click="onEditClick">Edit Details</button>
        </div>

        <div v-else>
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <button class="btn btn-danger mt-4" @click="logout">Log out</button>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            user: null,
        };
    },

    mounted() {
        this.getUserInfo();
    },

    methods: {
        getUserInfo() {
            axios
                .get("/api/profile/")
                .then((res) => {
                    this.user = res.data.user;
                    console.log(this.user);
                })
                .catch((error) => {
                    console.error("Error loading user data:", error);
                });
        },

        onEditClick() {
            console.log("Editing user details");
        },

        logout() {
            axios.post("/logout").then(() => {
                localStorage.removeItem("auth");
                this.$router.push({ name: "page.main" });
            });
        },
    },
};
</script>

<style scoped>
.profile-container {
    height: auto;
    background-color: #f0f8ff;
    padding: 20px;
}

.user-info {
    font-size: 1.2rem;
    max-width: 600px;
    width: 100%;
    background: linear-gradient(145deg, #2b91f7, #02478c);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), inset 0 -1px 4px rgba(255, 255, 255, 0.5);
    border-radius: 15px;
    padding: 20px;
}

.info-card {
    background-color: #ffffff;
    border-radius: 10px;
    font-size: 1rem;
}

button {
    font-size: 1rem;
    padding: 10px 20px;
    transition: all 0.3s ease;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.alert {
    font-size: 1rem;
    color: #856404;
    background-color: #fff3cd;
    border: 1px solid #ffeeba;
    border-radius: 5px;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
}
</style>