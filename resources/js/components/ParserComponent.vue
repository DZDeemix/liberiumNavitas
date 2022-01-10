<template>
    <div class="d-flex parser container">
        <LoadFileComponent @loadFile="loadFile" :errors="errors"></LoadFileComponent>
        <DashboardComponent :items="items"></DashboardComponent>
    </div>
</template>

<script>
import DashboardComponent from "./DashboardComponent";
import LoadFileComponent from "./LoadFileComponent";
export default {
  name: "ParserComponent",
  data() {
    return {
      items: [],
      errors: [],
    }
  },
  components: {
    DashboardComponent,
    LoadFileComponent
  },
  methods: {
    loadFile() {
      this.errors = [];
      var form = new FormData()
      var file = document.getElementById("file")
      form.append("file", file.files[0])
      axios.post('/api/parse', form)
        .then((response)=>{
          this.getQuantity()
          // eslint-disable-next-line no-prototype-builtins
          if(response.data.hasOwnProperty('errors')) {
            this.errors = response.data.errors
          }
        })
        .catch((response) => {
          console.log(response)
        })
        .finally(() => {
          file.value = ''
        })
    },
    getQuantity() {
      axios.post('/api/get-quantity')
        .then((response)=>{
          this.items = response.data
        })
        .catch((response) => {
          console.log(response)
        })
    }
  },
  created() {
    this.getQuantity()
  }
}
</script>

<style scoped>
.parser {
    background-color: #E2F0F0;
}
</style>
