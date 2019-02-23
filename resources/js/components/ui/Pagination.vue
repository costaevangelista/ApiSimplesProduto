<template>
  <div>
    <b-pagination
      :total-rows="totalRows"
      @change="navigate"
      v-model="currentPage"
      :per-page="perPage"
    />
  </div>
</template>


<script>
const items = [];

export default {
  name: "UiPagination",
  props: ["source"],

  data: () => ({
    items: items,
    currentPage: 1,
    perPage: 5,
    totalRows: items.length
  }),

  methods: {
    navigate(page) {
      this.$emit("navigate", page);
    }
  },

  watch: {
    source() {
      let s = this.source;
      this.currentPage = s.current_page;
      this.perPage = s.per_page;
      this.items = s.data.data;
      this.totalRows = s.total;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
