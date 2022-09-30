<template>
<div>
<CreateProduct></CreateProduct>

<div class="cards">
    <!-- filters -->
    <div class="filters">
        <div class="filter">
            <label for="category">Category</label>
            <select name="category" id="category" v-model="category"
                v-on:change="filterByCategory">
                <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id">{{ category.name }}</option>
            </select>
        </div>
        <div class="filter">
            <label for="price">Price</label>
            <select name="price" id="price" v-model="price" 
                v-on:change="filterByPrice">
                <option value="asc">Lowest to highest</option>
                <option value="desc">Highest to lowest</option>
            >
            </select>
        </div>
    </div>
    <div class="card" v-for="product in products" :key="product.id">
        <img :src="'http://127.0.0.1:8000/images/'+product.image" alt="product image">
        <div class="card-body">
            <h3>{{ product.name }}</h3>
            <p>{{ product.description }}</p>
            <p>{{ product.price }}</p>

        </div>
    </div>
</div>
</div>



    
</template>

<script>
import axios from 'axios'
import CreateProduct from "../components/CreateProduct";
export default {
    name: "ProductList",
    data() {
        return {
            products: [],
            categories: [],
            price: ''
        }
    },
    components: {
        CreateProduct
    },
    mounted() {
        this.getProducts();
        this.getCategories();
    },
    methods: {
        getProducts() {
            axios.get('http://localhost:8000/api/products')
                .then(response => {
                    this.products = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getCategories() {
            axios.get('http://localhost:8000/api/categories')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        filterByCategory() {
            axios.get('http://localhost:8000/api/products?category_id=' + this.category)
                .then(response => {
                    this.products = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        filterByPrice() {
            axios.get('http://localhost:8000/api/products?price=' + this.price)
                .then(response => {
                    this.products = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>


<style scoped>

.filters {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}
.filter {
    display: flex;
    flex-direction: column;
}
.cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.card {
    width: 300px;
    margin: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
    border-radius: 10px;
    overflow: hidden;
}

.card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

</style>