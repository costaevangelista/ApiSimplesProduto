<template>
  <div>
    <div>
      <div id="formCreateProduto" class="card">
        <div class="card-header font-weight-bold">
          <strong class="float-sm-right cursor-pointer" @click="acao(5)">
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
                    <label for="name">Nome:</label>
                    <b-form-input
                      :state="!errors.name ? null : false"
                      id="name"
                      v-model="produto.name"
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
                      v-model="produto.sku"
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
                      v-model="produto.description"
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
            <button class="btn btn-block btn-info" @click="createProduto">Salvar</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import SERVICE from "../../service/Configuration.vue";

export default {
  props: ["status"],
  name: "ProductFormCreate",
  data: () => ({
    name: "Criar Produto",
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
    }
  }),
  mounted() {},
  computed: {},
  methods: {
    createProduto: function(e) {
      e.preventDefault();
      var dados = this.produto;

      window.axios.post(SERVICE.API_URL + "products", dados).then(
        req => {
          this.$emit("addProduct", req.data);
          this.apagarErros();
          SERVICE.MENSAGEM_ALERT(
            "Produto Cadastrado",
            "O produto " + req.data.name + " foi cadastrado com sucesso!",
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
      this.apagarErros();
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
    status() {
      console.log("chamou source status create");
      let s = this.status;
      this.exibir = s;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
