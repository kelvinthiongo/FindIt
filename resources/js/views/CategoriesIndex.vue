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
      <li v-for="{ id, name } in categories">
        <strong>Id:</strong>
        {{ id }},
        <strong>Name:</strong>
        {{ name }}
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
        .get("/api/category")
        .then(response => {
          this.loading = false;
          this.categories = response.data;
        })
        .catch(error => {
          this.loading = false;
          this.error = error.response.data.message || error.message;
        });
    }
  }
};
</script>
