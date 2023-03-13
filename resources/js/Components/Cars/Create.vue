<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { useForm } from "@inertiajs/vue3";

const emit = defineEmits(['add'])

const form = useForm({
  brand: "",
  variant: "",
  license_plate: "",
  fuel_type: "",
  price: "",
  sales_type: "",
  reserved: false,
});

const createCar = () => {
  fetch("/api/cars", {
    method: "POST", // or 'PUT'
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(form),
  })
    .then((response) => response.json())
    .then((response) => {
      if (response.success === true) {
        emit('add', response.data);
        form.reset()
      } else {
        form.errors = response.errors
      }

    })
    .catch((error) => {
      console.error("Error:", error);
    });
};
</script>

<template>
  <form @submit.prevent="createCar" class="mt-6 space-y-6">
    <div>
      <InputLabel for="brand" value="Marque" />

      <TextInput
        id="brand"
        v-model="form.brand"
        type="text"
        class="mt-1 block w-full"
      />

      <InputError :message="form.errors.brand" class="mt-2" />
    </div>
    <div>
      <InputLabel for="variant" value="Modèle" />

      <TextInput
        id="variant"
        v-model="form.variant"
        type="text"
        class="mt-1 block w-full"
      />

      <InputError :message="form.errors.variant" class="mt-2" />
    </div>
    <div>
      <InputLabel for="license_plate" value="Plaque d'immatriculation" />

      <TextInput
        id="license_plate"
        v-model="form.license_plate"
        type="text"
        class="mt-1 block w-full"
      />

      <InputError :message="form.errors.license_plate" class="mt-2" />
    </div>
    <div>
      <InputLabel for="fuel_type" value="Carburant" />

      <TextInput
        id="fuel_type"
        v-model="form.fuel_type"
        type="text"
        class="mt-1 block w-full"
      />

      <InputError :message="form.errors.fuel_type" class="mt-2" />
    </div>
    <div>
      <InputLabel for="price" value="Prix" />

      <TextInput
        id="price"
        v-model="form.price"
        type="text"
        class="mt-1 block w-full"
      />

      <InputError :message="form.errors.price" class="mt-2" />
    </div>
    <div>
      <InputLabel for="sales_type" value="Type de vente" />

      <select id="sales_type"
        v-model="form.sales_type"
        type="text"
        class="mt-1 block w-full">
        <option value="used">occasion</option>
        <option value="new">neuve</option>
      </select>

      <InputError :message="form.errors.sales_type" class="mt-2" />
    </div>
    <div>
      <InputLabel for="reserved" value="Réservé ?" />

      <Checkbox v-model="form.reserved" />

      <InputError :message="form.errors.reserved" class="mt-2" />
    </div>
    <PrimaryButton>Save</PrimaryButton>
  </form>
</template>