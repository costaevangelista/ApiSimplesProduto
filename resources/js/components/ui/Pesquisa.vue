<template>
  <div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <b-form>
          <b-form-group>
            <b-row class="my-1">
              <b-col sm="12">
                <b-form-input
                  v-on:keyup="busca"
                  id="name"
                  v-model="filterTerm"
                  type="text"
                  placeholder="Busca por nome..."
                />
              </b-col>
            </b-row>
          </b-form-group>
        </b-form>
      </li>
    </ul>
  </div>
</template>


<script>
export default {
  data() {
    return {
      filterTerm: ""
    };
  },

  methods: {
    busca(ev) {
      ev.preventDefault();
      this.$emit("busca", this.filterTerm);
    }
  }
};
</script>


