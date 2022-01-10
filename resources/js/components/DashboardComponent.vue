<template>
    <div class="dashboard">
        <div>
            <h2>Dasboard</h2>
        </div>
        <div class="">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">date</th>
                        <th scope="col">Qoil fact</th>
                        <th scope="col">Qliq fact</th>
                        <th scope="col">Qoil forecast</th>
                        <th scope="col">Qliq forecast</th>
                    </tr>
                </thead>
                <tbody>
                    <dash-board-row-component v-for="item in items" :item="item" :key="item.data"></dash-board-row-component>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import DashBoardRowComponent from "./DashBoardRowComponent";
export default {
  name: "DashboardComponent",
  props: {
    items: {
      required: true,
      type: Array
    }
  },
  components: {
    DashBoardRowComponent
  }
}
</script>

<style scoped>
.table tr td{
    width: 20%;
}
.dashboard {
    width: 100%;
}
</style>
