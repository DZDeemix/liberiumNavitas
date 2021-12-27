<template>
    <div>
        <LoadFileComponent></LoadFileComponent>
        <DashboardComponent></DashboardComponent>
    </div>
</template>

<script>
import DashboardComponent from "./DashboardComponent";
import LoadFileComponent from "./LoadFileComponent";
export default {
  name: "ParserComponent",
  components: {
    DashboardComponent,
    LoadFileComponent
  }
}
</script>

<style scoped>

</style>
