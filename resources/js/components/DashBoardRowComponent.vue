<template>
    <tr>
        <th scope="row">{{ item.date }}</th>
        <td>{{item.fact_Qoil}}</td>
        <td>{{item.fact_Qliq}}</td>
        <td>{{item.forecast_Qoil}}</td>
        <td>{{item.forecast_Qliq}}</td>
    </tr>
</template>

<script>
export default {
  name: "DashBoardRowComponent",
  props: {
    item: {
      type: Array,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
