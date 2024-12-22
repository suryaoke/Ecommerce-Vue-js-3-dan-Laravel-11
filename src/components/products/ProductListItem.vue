<template>
  <div class="col-md-6">
    <div class="card mb-2" style="max-width: 320px">
      <img :src="product.thumbnail" class="card-img-top" alt="Product Image">
      <div class="card-body">
        <h5 class="card-title">{{ product.name }}</h5>
        <p class="card-text" v-dompurify-html="product.desc.substr(0, 50)">

        </p>
        <div class="d-flex justify-content-between align-items-center">
          <span class="h5 mb-0">${{ product.price }} </span>
          <div>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-half text-warning"></i>
            <small class="text-muted">(4.5)</small>
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-between bg-light">
        <button class="btn btn-danger btn-sm">

          <i class="bi bi-cart-plus"></i> Add to Cart</button>
        <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-heart"></i></button>
      </div>
    </div>
  </div>
</template>

<script setup>
// define the props
const props = defineProps({
  product: {
    type: Object,
    required: true
  }
})
</script>

<style></style>