<template>
    <div v-if="order" class="order-container container mt-4 mb-4">
        <div class="order-summary mb-4">
            <h2 class="order-title">Order #{{ this.id }}</h2>
            <p class="order-total text-success" v-if="order.status">Status: complete</p>
            <p class="order-total text-danger" v-else>Status: in processing</p>
            <p class="order-total">Total: <span class="order-sum">{{ order.orderSum }} $</span></p>
        </div>

        <div class="row gy-4">
            <div v-for="product in order.products" :key="product.id" class="col-md-3">
                <div class="card h-100 shadow-sm" @click="goToProduct(product.id)">
                    <img :src="product.image_url" class="card-img-top" alt="Product Image" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ product.title }}</h5>
                        <p class="card-text text-muted">{{ product.description }}</p>
                        <p class="product-price">
                            <span v-if="product.old_price" class="old-price">{{ product.old_price }} $</span>
                            {{ product.price }} $
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-else>Loading...</div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            order: null
        }
    },

    props: {
        id: String,
    },

    mounted() {
        this.getProduct();
    },

    methods: {
        getProduct() {
            axios.get(`/api/orders/show/${this.id}`)
                .then(res => {
                    this.order = res.data.data;
                });
        },

        goToProduct(id) {
            this.$router.push(`/product/show/${id}`);
        },
    },
}
</script>

<style scoped>
.order-container {
    background-color: #f8f9fa;
    padding-top: 20px;
}

.order-summary {
    background-color: #2190ff;
    color: white;
    padding: 15px;
    border-radius: 8px;
}

.order-title {
    font-size: 1.8rem;
    font-weight: bold;
}

.order-total {
    font-size: 1.2rem;
    font-weight: 600;
    margin-top: 10px;
}

.order-sum {
    color: #ffcc00;
    font-weight: 700;
}

.card {
    transition: transform 0.2s;
    height: 100%;
    border-radius: 8px;
}

.card:hover {
    transform: scale(1.05);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}

.card-title {
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.card-text {
    max-height: 3em;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.product-price {
    font-size: 1.0rem;
    font-weight: 600;
    color: #0066cc;
}

.old-price {
    color: red;
    text-decoration: line-through;
    margin-right: 10px;
}
</style>