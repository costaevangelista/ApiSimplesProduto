<template>
  <div>
    <div v-if="source != null">
      <div id="exibir" class="card">
        <div class="card-header font-weight-bold">
          <strong class="float-sm-right cursor-pointer" @click="acao(1)">
            <i class="btn btn-sm btn-info rounded-circle material-icons">clear</i>
          </strong>
          Detalhes do Produto
        </div>

        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            SKU
            <span class="font-weight-bold">{{item.sku}}</span>
          </li>
          <li class="list-group-item">Nome
            <br>
            <span class="font-weight-bold">{{item.name}}</span>
          </li>
          <li class="list-group-item">Descrição
            <br>
            <span class="font-weight-bold">{{item.description}}</span>
          </li>
          <li class="list-group-item">
            <button @click="acao(2)" class="btn btn-block btn-info align-middle">
              <i class="material-icons align-middle">edit</i> Editar
            </button>
          </li>
          <li class="list-group-item">
            <button @click="acao(4)" class="btn btn-block btn-danger align-middle">
              <i class="material-icons align-middle">delete_sweep</i> Remover
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import SERVICE from "../../service/Configuration.vue";
const item = {};
export default {
  props: ["source", "status"],
  name: "ProductExibir",
  data: () => ({
    name: "Exibir Produto",
    exibir: false,
    item: item
  }),
  methods: {
      acao(tipo){
        this.$emit("acao", tipo);
      }
  },
  watch: {
    source() {
      let s = this.source;
      this.item = s;
    },
    status() {
      let s = this.status;
      this.exibir = s;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
