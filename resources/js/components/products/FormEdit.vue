<template>
  <div>
    <div v-if="source != null">
      <div id="formEditProduto" class="card">
        <div class="card-header font-weight-bold">
          <strong class="float-sm-right cursor-pointer" @click="acao(3)">
            <i class="btn btn-sm btn-info rounded-circle material-icons">clear</i>
          </strong>
          {{name}}
        </div>

        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <b-form>
              <b-form-group>
                <b-row class="my-1">
                  <b-col sm="8">
                    <label for="name">Name:</label>
                    <b-form-input
                      :state="!errors.name ? null : false"
                      id="name"
                      v-model="item.name"
                      type="text"
                      placeholder="Digite o nome do produto"
                    />
                    <b-form-invalid-feedback
                      id="name"
                      v-if="errors.name"
                    >{{ errors.name | forText }}</b-form-invalid-feedback>
                  </b-col>
                  <b-col sm="4">
                    <label for="sku">SKU:</label>
                    <b-form-input
                      :state="!errors.sku ? null : false"
                      id="sku"
                      v-model="item.sku"
                      type="text"
                      placeholder="Digite o SKU do produto"
                    />
                    <b-form-invalid-feedback id="sku" v-if="errors.sku">{{ errors.sku | forText }}</b-form-invalid-feedback>
                  </b-col>
                  <b-col sm="12">
                    <label for="description">Descrição:</label>
                    <b-form-textarea
                      :state="!errors.description ? null : false"
                      id="description"
                      v-model="item.description"
                      rows="3"
                      max-rows="6"
                      placeholder="Digite a Descrição do produto"
                    />
                    <b-form-invalid-feedback
                      v-if="errors.description"
                    >{{ errors.description | forText }}</b-form-invalid-feedback>
                  </b-col>
                </b-row>
              </b-form-group>
            </b-form>
          </li>
          <li class="list-group-item">
            <button class="btn btn-block btn-info" @click="editProduto">Salvar</button>
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
  name: "ProductFormEdit",
  data: () => ({
    name: "Editar Produto",
    exibir: false,
    produto: {
      name: "",
      sku: "",
      description: ""
    },
    errors: {
      name: "",
      sku: "",
      description: ""
    },
    item: item
  }),
  mounted() {},
  computed: {},
  methods: {
    editProduto: function(e) {
      e.preventDefault();

      this.produto.name = this.item.name;
      this.produto.sku = this.item.sku;
      this.produto.description = this.item.description;

      var dados = this.produto;

      window.axios
        .put(SERVICE.API_URL + "products/" + this.item.id, dados)
        .then(
          req => {
            //this.$emit("listar");
            this.apagarErros();
            SERVICE.MENSAGEM_ALERT(
              "Produto Editado",
              "O produto " + req.data.name + " foi editado com sucesso!",
              "success"
            );
          },
          error => {
            this.errors.name = error.response.data.name;
            this.errors.sku = error.response.data.sku;
            this.errors.description = error.response.data.description;
          }
        );
    },
    apagarErros: function() {
      this.errors.name = "";
      this.errors.sku = "";
      this.errors.description = "";

      this.produto.name = "";
      this.produto.sku = "";
      this.produto.description = "";
    },
    acao(tipo) {
      this.$emit("acao", tipo);
    }
  },
  filters: {
    forText: function(value) {
      if (!value) return "";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
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
