<template>
    <div class="container mt-4">
        <h2 class="text-primary">Orders</h2>
        <div class="row">
            <div v-for="order in orders" :key="order.id" class="col-md-6 mb-3">
                <div class="card order-card"
                    :class="order.status ? 'border-success bg-light-green' : 'border-danger bg-light-red'"
                    @click.prevent="openOrder(order.id)">
                    <div class="card-body">
                        <h5 class="card-title">Order #{{ order.id }}</h5>
                        <p class="card-text">Products: {{ order.productsQuantity.reduce((acc, val) =>
                            acc + val, 0) }}</p>
                        <p class="card-text">Sum: <strong>{{ order.orderSum }} $</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            orders: null,
        }
    },

    mounted() {
        this.getOrders();
    },

    methods: {
        getOrders() {
            axios.get('/api/orders/index')
                .then(res => {
                    this.orders = res.data.data;
                });
        },

        openOrder(orderId) {
            this.$router.push(`/profile/order/${orderId}`);
        }
    },
}
</script>

<style scoped>
.order-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    cursor: pointer;
}

.order-card:hover {
    transform: scale(1.05);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

.bg-light-green {
    background-color: #d4edda !important;
}

.bg-light-red {
    background-color: #f8d7da !important;
}
</style>