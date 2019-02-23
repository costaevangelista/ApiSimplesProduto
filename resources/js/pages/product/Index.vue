<template>
  <div class="row">
    <div
      v-show="list"
      v-bind:class="{ 'col-md-8': classObjectDisplay, 'col-md-12': !classObjectDisplay  }"
    >
      <div class="card">
        <div class="card-header bg-ligth">
          <h4>
            {{name}}
            <span class="float-sm-right cursor-pointer" title="Criar novo Produto" @click="acao(0)">
              <i class="btn btn-sm btn-primary rounded-circle material-icons">add</i>
            </span>
          </h4>
        </div>

        <div>
          <cw-pesquisa @busca="busca"></cw-pesquisa>
        </div>
      </div>
      <br>

      <b-table
        bordered
        responsive
        striped
        hover
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        :items="items"
        :fields="fields"
      >
        <b-container slot="Exibir" class="col-md-2" slot-scope="row">
          <b-row>
            <i
              v-b-popover.hover.top="'Exibir Produto'"
              @click="toggleDetails(row.item)"
              class="material-icons text-info cursor-pointer"
            >
              <h3>visibility</h3>
            </i>
          </b-row>
        </b-container>
      </b-table>
      <cw-pagination :source="pagination" @navigate="navigate"></cw-pagination>
    </div>
    <!-- Init Exibir -->
    <div
      v-show="exibir"
      v-bind:class="{  'display-active-cw': !classObjectDisplay, 'col-md-4': classObjectDisplay   }"
    >
      <cw-form-exibir-product
        v-show="exibir"
        :source="item"
        :status="exibir"
        @acao="acao"
        @navigate="navigate"
      ></cw-form-exibir-product>
    </div>
    <!-- Fim do Exibir -->
    <!-- Init do Create -->
    <div
      v-show="create"
      v-bind:class="{  'display-active-cw': !classObjectDisplay, 'col-md-4': classObjectDisplay   }"
    >
      <cw-form-create-product
        v-show="create"
        :status="create"
        @acao="acao"
        @addProduct="addProduct"
        @navigate="navigate"
      ></cw-form-create-product>
    </div>
    <!-- Fim do create -->
    <!-- Init do Editar -->
    <div
      v-show="edit"
      v-bind:class="{  'display-active-cw': !classObjectDisplay, 'col-md-4': classObjectDisplay   }"
    >
      <cw-form-edit-product
        v-show="edit"
        :source="item"
        :status="edit"
        @acao="acao"
        @navigate="navigate"
      ></cw-form-edit-product>
    </div>
    <!-- Fim do Exibir -->
  </div>
</template>


<script>
import SERVICE from "../../service/Configuration.vue";
Vue.component(
  "CwPagination",
  require("../../components/ui/Pagination").default
);

Vue.component("cw-pesquisa", require("../../components/ui/Pesquisa").default);

Vue.component(
  "cw-form-create-product",
  require("../../components/products/FormCreate").default
);

Vue.component(
  "cw-form-edit-product",
  require("../../components/products/FormEdit").default
);

Vue.component(
  "cw-form-exibir-product",
  require("../../components/products/Exibir").default
);

const items = [];

export default {
  name: "ProductIndex",
  data: () => ({
    name: "Produtos",

    classObjectDisplay: false,
    isActive: true,
    hasError: true,
    exibir: false,
    create: false,
    edit: false,
    list: true,

    sortBy: "name",
    sortDesc: false,
    sortDirection: "asc",
    filter: null,
    fields: [
      { key: "sku", sortable: true },
      { key: "name", sortable: true, class: "col-md-4" },
      { key: "Exibir", sortable: false, class: "text-center" }
    ],
    items: items,
    totalRows: items.length,
    currentPage: 1,
    pagination: {},
    item: {}
  }),
  mounted() {
    window.axios
      .get(SERVICE.API_URL + "products")
      .then(req => {
        this.pagination = req.data;
        this.items = req.data.data;
        this.currentPage = req.current_page;
      })
      .catch(erro => {});
  },
  computed: {},
  methods: {
    navigate(pageNum) {
      window.axios
        .get(SERVICE.API_URL + "products?page=" + pageNum)
        .then(req => {
          this.pagination = req.data;
          this.items = req.data.data;
          this.currentPage = req.current_page;
        })
        .catch(erro => {});
    },
    toggleDetails(item) {
      this.item = item;
      this.classObjectDisplay = true;
      this.exibir = true;
    },
    closeDetails() {
      this.classObjectDisplay = false;
    },

    productFindId(id) {
      if (id === null) {
        window.axios
          .get(SERVICE.API_URL + "products/" + this.item.id)
          .then(req => {
            this.item = req.data;
          })
          .catch(erro => {});
      }
      window.axios
        .get(SERVICE.API_URL + "products/" + id)
        .then(req => {
          this.item = req.data;
        })
        .catch(erro => {});
    },

    listar() {
      window.axios
        .get(SERVICE.API_URL + "products?page=" + this.pagination.current_page)
        .then(req => {
          this.pagination = req.data;
          this.items = req.data.data;
          this.currentPage = req.current_page;
        })
        .catch(erro => {});
    },

    busca(palavra) {
      if (palavra.length > 1) {
        window.axios
          .get(SERVICE.API_URL + "products/searchName/" + palavra)
          .then(req => {
            this.pagination = req.data;
            this.items = req.data.data;
            this.currentPage = req.current_page;
          });
      }
      if (palavra.length == 0) {
        this.listar();
      }
    },

    acao(opcao) {
      console.log("opcap:", opcao);
      if (opcao === 0) {
        this.classObjectDisplay = true;
        this.list = true;
        this.exibir = false;
        this.edit = false;
        this.create = true;
      }
      if (opcao === 1) {
        this.classObjectDisplay = false;
        this.exibir = false;
        this.edit = false;
      }
      if (opcao === 2) {
        this.classObjectDisplay = true;
        this.list = true;
        this.exibir = false;
        this.edit = true;
      }
      if (opcao === 3) {
        this.productFindId((id = null));
        this.listar();
        this.classObjectDisplay = true;
        this.editar = false;
        this.exibir = true;
      }
      if (opcao === 4) {
        swal({
          title: "Deseja apagar a Produto?",
          text:
            "Uma vez excluído, você não poderá recuperar informações de: " +
            this.item.name,
          icon: "warning",
          buttons: true,
          dangerMode: true
        }).then(willDelete => {
          if (willDelete) {
            window.axios
              .delete(SERVICE.API_URL + "products/" + this.item.id)
              .then(
                req => {
                  this.acao(1);
                  this.listar();
                  this.item = {};
                  SERVICE.MENSAGEM_ALERT(
                    "Pronto! Produto Apagado",
                    "O Produto foi removido com sucesso!",
                    "success"
                  );
                },
                error => {
                  SERVICE.MENSAGEM_ALERT(
                    "Error!",
                    error.response.data.mensagem,
                    "error"
                  );
                }
              );
          } else {
          }
        });
      }
      if (opcao === 5) {
        this.classObjectDisplay = false;
        this.exibir = false;
        this.list = true;
        this.edit = false;
        this.create = false;
      }
    },

    addProduct(dados) {
      console.log("dados", dados);
      this.listar();
      this.productFindId(dados.id);
      this.edit = false;
      this.create = false;
      this.exibir = true;
    },

    linkClass(idx) {
      if (this.tabIndex === idx) {
        return ["bg-primary", "text-light"];
      } else {
        return ["bg-light", "text-info"];
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.display-active-cw {
  display: none;
  animation-delay: 2s;
  animation-duration: 5s;
}
.cursor-pointer {
  cursor: pointer;
}

.cw-width {
  width: 80%;
}
</style>
