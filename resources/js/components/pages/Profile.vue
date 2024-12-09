<template>

    <div  class="profile-container d-flex flex-column align-items-center text-center mt-5">

        <div v-if="user" class="user-info mt-5">
            <h1 class="mb-4">Welcome, {{ user.name }} {{ user.surname }}!</h1>
            <div class="info-card shadow-sm p-4 mb-4 bg-white rounded">
                <p><strong>Email:</strong> {{ user.email }}</p>

                <p><strong>Gender: </strong>
                    <template v-if="editorMode">
                        <select name="gender" v-model="this.newUserData.gender" class="form-control" id="gender">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Not specified</option>
                        </select>
                    </template>
                    <template v-else>
                    <span :class="{ 'text-danger': !user.gender }">
                        {{ getGenderTitle(user.gender) || 'Not specified' }}</span>
                    </template>
                </p>

                <p><strong>Age: </strong>
                    <template v-if="editorMode">
                        <input type="number" v-model="this.newUserData.age" name="age" id="age" placeholder="Enter age...">
                    </template>
                    <template v-else>
                    <span :class="{ 'text-danger': !user.age }">
                        {{ user.age || 'Not specified' }}</span>
                    </template>
                </p>

                <p><strong>Address: </strong>
                    <template v-if="editorMode">
                        <input type="text" name="address" v-model="this.newUserData.address" id="address" placeholder="Enter address...">
                    </template>
                    <template v-else>
                    <span :class="{ 'text-danger': !user.address }">
                        {{ user.address || 'Not specified' }}</span>
                    </template>
                </p>

                <template v-if="editorMode">
                    <div>
                        <button @click.prevent="editData" class="btn btn-primary">Submit</button>
                    </div>
                </template>

            </div>
            <button class="btn btn-primary mt-3" @click.prevent="changeEditorMode">Edit Details</button>
        </div>

        <div v-else>
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div v-if="profileInfoCheck" class="alert alert-warning mt-4 fs-3" >
            Please enter all data for ordering
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
            editorMode: false,

            newUserData: {
                gender: null,
                address: null,
                age: null,
            }
        };
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
            axios
                .get("/api/profile/")
                .then((res) => {
                    this.user = res.data.data;
                    this.newUserData = res.data.data;
                })
                .catch((error) => {
                    console.error("Error loading user data:", error);
                });
        },

        changeEditorMode() {
            this.editorMode = !this.editorMode;
        },

        editData() {
            axios.post('/api/profile/edit', {
                gender: this.newUserData.gender,
                age: this.newUserData.age,
                address: this.newUserData.address,
            }).then(res => {
                this.editorMode = false;
                this.getUserInfo();
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