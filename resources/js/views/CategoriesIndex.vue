<template>
  <div class="categories">
    <div class="loading" v-if="loading">Loading...</div>

    <div v-if="error" class="error">
      <p>{{ error }}</p>

      <p>
        <button @click.prevent="fetchData">Try Again</button>
      </p>
    </div>

    <ul v-if="categories">
      <li v-for="category in categories">
        <strong>code:</strong>
        {{ category.code }},
        <strong>Rate:</strong>
        {{ category.rate }}
      </li>
    </ul>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      loading: false,
      categories: null,
      error: null
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      this.error = this.categories = null;
      this.loading = true;
      axios
        .get("https://api.coindesk.com/v1/bpi/currentprice.json")
        .then(response => {
          this.loading = false;
          this.categories = response.data.bpi;
        })
        .catch(error => {
          this.loading = false;
          this.error = error.response.data.message || error.message;
        });
    }
  }
};
</script>
