<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { useForm } from "@inertiajs/vue3";
import { toRefs , reactive} from 'vue';

const emit = defineEmits(['update'])
const props = defineProps(["id"]);
const { id } = toRefs(props);

const response = await fetch(`/api/cars/${id.value}`).then((r) => r.json());
const car = reactive(response.data);
const form = useForm({
  id: car.id,
  brand: car.brand,
  variant: car.variant,
  license_plate: car.license_plate,
  fuel_type: car.fuel_type,
  price: car.price,
  sales_type: car.sales_type,
  reserved: car.reserved,
});

const updateCar = () => {
  fetch(`/api/cars/${id.value}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(form),
  })
    .then((response) => response.json())
    .then((response) => {
      if (response.success === true) {
        emit('update', response.data);
      } else {
        form.errors = data.errors
      }

    })
    .catch((error) => {
      console.error("Error:", error);
    });
};
</script>

<template>
  <form @submit.prevent="updateCar" class="mt-6 space-y-6">
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