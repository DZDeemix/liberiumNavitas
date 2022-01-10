<template>
    <div class="loadFileform">
        <div class="d-flex justify-content-center mb-4">
            <form id="fileUpload" enctype="multipart/form-data">
                <label class="btn btn-outline-primary mt-3 btn-custom">
                    Open file
                    <input accept=".xls, .xlsx" id="file" @input="$emit('loadFile')" type="file" name="file" hidden>
                </label>
            </form>
        </div>
        <div class="error" v-if="errors.length">
            <h5>Всего ошибок {{errors.length}}</h5>
            <div v-for="error in errors" :key="error.row">
                <p>строка {{error.row}} : {{error.message}}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: "LoadFileComponent",
  props: {
    errors: {
      type: Array
    },
  }
}
</script>

<style scoped>
.loadFileform {
    width: 400px;
}
.btn-custom {
    width: 200px;
    background-color: white;
    border-radius: 30px;
}
.error {
    color: red;
}
</style>
