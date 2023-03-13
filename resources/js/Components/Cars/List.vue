<script setup>
import { reactive, ref, toRefs } from 'vue';
import CarsUpdate from "@/Components/Cars/Update.vue";
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const emit = defineEmits(['refresh'])
const props = defineProps(["cars"]);
const { cars } = toRefs(props);

const updateCar = ref(false);
let id = reactive(0)
const closeModal = () => {
  updateCar.value = false;
};

const openModal = (car) => {
  id = car.id
  updateCar.value = true;
}

const handleUpdateRow = (updatedCar) => {
  emit('refresh', updatedCar)
  updateCar.value = false;
}

const removeCar = (deleteCar) => {
  fetch(`/api/cars/${deleteCar.id}`, {
    method: "DELETE",
  })
    .then((response) => response.json())
    .then((response) => {
      if (response.success === true) {
        emit('delete', deleteCar);
      } else {
        form.errors = data.errors
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

</script>

<template>
  <table
    id="table_voitures"
    class="border-separate border-spacing-2 border border-slate-500 mt-4 text-gray-500 dark:text-gray-400 text-sm"
  >
    <thead>
      <tr>
        <th class="border border-slate-700">Marque</th>
        <th class="border border-slate-700">Modèle</th>
        <th class="border border-slate-700">Plaque immatriculation</th>
        <th class="border border-slate-700">Carburant</th>
        <th class="border border-slate-700">Prix</th>
        <th class="border border-slate-700">Type de vente</th>
        <th class="border border-slate-700">Réservé</th>
        <th class="border border-slate-700">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(car, index) in cars" :key="index">
        <td class="border border-slate-700">{{ car.brand }}</td>
        <td class="border border-slate-700">{{ car.variant }}</td>
        <td class="border border-slate-700">{{ car.license_plate }}</td>
        <td class="border border-slate-700">{{ car.fuel_type }}</td>
        <td class="border border-slate-700">{{ car.price }}</td>
        <td class="border border-slate-700">{{ car.sales_type }}</td>
        <td class="border border-slate-700">{{ car.reserved }}</td>
        <td class="border border-slate-700">
          <SecondaryButton @click="openModal(car)">Edit </SecondaryButton>
          <SecondaryButton @click="removeCar(car)">Delete </SecondaryButton>
        </td>
      </tr>
    </tbody>
  </table>
  <Modal :show="updateCar" @close="closeModal">
    <div class="p-6">
      <h2 class="text-lg font-medium text-gray-900">
          Mise à jour de la voiture
      </h2>
      <CarsUpdate :id="id" @update="handleUpdateRow" />
    </div>
  </Modal>
</template>
