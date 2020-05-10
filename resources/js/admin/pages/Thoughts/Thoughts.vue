<template>
  <div>
        <h1 class="page-title">Thoughts</h1>
    <b-row>
      <b-col>
        <b-pagination-nav :link-gen="linkGen" :number-of-pages="numberPages" @change="getData" use-router></b-pagination-nav>
      </b-col>
    </b-row>
    <b-row v-if="data.length !== 0">
      <b-col v-for="(v, i) in data" :key="i" lg="4">
        <b-card class="card-small card-post mb-4 shadow">
            <h5 class="card-title">{{ v.name | ucfirst }}</h5>
            <p class="card-text text-muted">{{ v.comment }}</p>

            <div class="d-flex border-top flex-column justify-content-center pt-3">
              <small class="text-muted">Date Added : {{ v.created_at | prettyDateCompat}}</small>
            </div>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>
<script>
export default {
  name: "Thoughts",
  data: function() {
    return {
      data: [],
      numberPages: null
    };
  },
  created() {
    this.getData()
  },
  methods: {
    linkGen(pageNum) {
      return pageNum === 1 ? "?" : `?page=${pageNum}`;
    },
    getData() {
      let page = this.$route.query.page || 1;
      axios
        .get(`/thoughts?page=${page}`)
        .then(response => {
          this.data = response.data.data;
          this.numberPages = response.data.last_page
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
<style>
</style>
