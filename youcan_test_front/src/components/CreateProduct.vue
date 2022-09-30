<template>

<div>
    <h1>Create Product</h1>

    <!-- success message -->
    <div v-if="success" class="alert-success">
        {{ success }}
    </div>
    <form @submit.prevent="createProduct" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" v-model="name">
        </div>  
        <div class="form-group">
            <label for="description">description</label>
            <input type="text" class="form-control" id="description" placeholder="Enter description" v-model="description">
        </div>
        <div class="form-group">
            <label for="price">price</label>
            <input type="text" class="form-control" id="price" placeholder="Enter price" v-model="price">
        </div>
        <!-- category -->
        <div class="form-group">
            <label for="category">category</label>
            <select class="form-control" id="category" v-model="category">
                <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id">
                    {{ category.name }}</option>
            </select>
        </div>
        <!-- image -->
        <div class="form-group">
            <label for="image">image</label>
            <input type="file" class="form-control" id="image" placeholder="Enter image" v-on:change="onChange"
          >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
    
</template>



<script>
import axios from 'axios'
export default {
    name: "CreateProduct",
    data() {
        return {
            name: '',
            description: '',
            price: '',
            category: '',
             file: this.file,
            categories: [],
            success: ''
        }
    },
    mounted() {
        this.getCategories();
    },
    methods: {

        getCategories() {
            axios.get('http://localhost:8000/api/categories')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        createProduct() {
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('description', this.description);
            formData.append('price', this.price);
            formData.append('category_id', this.category);
            formData.append('image', this.file);

            axios.post('http://localhost:8000/api/createPro', formData)
                .then(response => {
                    this.success = response.data.message;
                    this.name = '';
                    this.description = '';
                    this.price = '';
                    this.category = '';
                    this.image = '';
                })
                .catch(error => {
                    console.log(error);
                });
        },
         onChange(e) {
      this.file = e.target.files[0];
      
    },
    }
    
}
</script>


<style scoped>
.alert-success {
    padding: 20px;
    background-color: #4CAF50;
    color: white;
}

form {
    width: 50%;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 1rem;
    width: 100%;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
}

.form-group option {
    display: block;
    margin-bottom: 0.5rem;
}

.form-group input {
   width: 100%;
   padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;

}

.form-group select {
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
}



</style>