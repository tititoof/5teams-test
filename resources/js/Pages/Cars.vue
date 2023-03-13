<script setup>
import { reactive, ref } from "vue";
import CarsList from "@/Components/Cars/List.vue";
import CarsCreate from "@/Components/Cars/Create.vue";

const response = await fetch("/api/cars").then((r) => r.json());

let cars = reactive(response.data);
const handleAddRow = (newRow) => {
  cars.push(newRow)
};
const handleUpdateRow = (updatedCar) => {
  for (const [key, car] of cars.entries()) {
    if (car.id === updatedCar.id) {
      cars[key] = updatedCar
    }
  }
}

const handleDeleteRow = (deletedCar) => {
  console.log(deletedCar, cars)
  cars.splice(cars.indexOf(deletedCar), 1);
  console.log('----', deletedCar, cars)
}
</script>

<template>
  <CarsList :cars="cars" @refresh="handleUpdateRow" @delete="handleDeleteRow"/>

  <div class="grid grid-flow-col auto-cols-max">
    <CarsCreate @add="handleAddRow" />
  </div>
</template>