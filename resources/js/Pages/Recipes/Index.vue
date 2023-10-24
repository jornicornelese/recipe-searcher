<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BlockRecipe from "@/Blocks/Recipe.vue";
import { Head, useForm } from "@inertiajs/vue3";
import axios from "axios";

const { cuisines } = defineProps({
  cuisines: Array,
});

const form = useForm({
  query: "",
  maxReadyTime: 30,
  cuisine: "",
  vegetarian: false,
});

const recipe = ref(null);

const submit = () => {
  axios.post(route("api.recipes.search"), form.data()).then((response) => {
    recipe.value = response.data.data;
  });
};
</script>

<template>
  <Head title="Receptenzoeker" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Receptenzoeker
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <form class="p-6 mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6" @submit.prevent="submit">
            <div class="sm:col-span-3">
              <label for="query" class="block text-sm font-medium leading-6 text-gray-900">Wat wil je eten?</label>
              <div class="mt-2">
                <input type="text" v-model="form.query" id="query"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
              </div>
              <div v-if="form.errors.query">
                {{ form.errors.query }}
              </div>
            </div>
            <div class="sm:col-span-3">
              <label for="cuisine" class="block text-sm font-medium leading-6 text-gray-900">Cuisine</label>
              <div class="mt-2">
                <select name="cuisine"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  v-model="form.cuisine" id="">
                  <option value="">Selecteer een cuisine</option>
                  <option v-for="cuisine in cuisines" :key="cuisine" :value="cuisine">{{ cuisine }}</option>
                </select>
              </div>

              <div v-if="form.errors.cuisine">
                {{ form.errors.cuisine }}
              </div>
            </div>
            <div class="sm:col-span-3">
              <label for="maxReadyTime" class="block text-sm font-medium leading-6 text-gray-900">Bereidingstijd</label>
              <div class="mt-2">
                <input type="text" v-model="form.maxReadyTime" id="maxReadyTime"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
              </div>
              <div v-if="form.errors.maxReadyTime">
                {{ form.errors.maxReadyTime }}
              </div>
            </div>
            <div class="sm:col-span-3">
              <label for="vegetarian" class="block text-sm font-medium leading-6 text-gray-900">Vegetarisch</label>
              <div class="mt-2">
                <input type="checkbox" v-model="form.vegetarian" id="vegetarian"
                  class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
              </div>
              <div v-if="form.errors.vegetarian">
                {{ form.errors.vegetarian }}
              </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
              <button :disabled="form.processing" type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Search
              </button>
            </div>
          </form>
          <div v-if="recipe">
            <div class="p-4 md:w-1/2">
              <BlockRecipe :recipe="recipe" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
