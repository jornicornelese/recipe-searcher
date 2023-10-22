<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import axios from "axios";

defineProps({
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
          <form
            class="p-6 mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
            @submit.prevent="submit"
          >
            <div class="sm:col-span-3">
              <label
                for="query"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Wat wil je eten?</label
              >
              <div class="mt-2">
                <input
                  type="text"
                  v-model="form.query"
                  id="query"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
              </div>
              <div v-if="form.errors.query">
                {{ form.errors.query }}
              </div>
            </div>
            <div class="sm:col-span-3">
              <label
                for="cuisine"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Cuisine</label
              >
              <div class="mt-2">
                <select
                  name="cuisine"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  v-model="form.cuisine" 
                  id="">
                  <option value="">Selecteer een cuisine</option>
                  <option v-for="cuisine in cuisines" :key="cuisine" :value="cuisine">{{ cuisine }}</option>
                </select>
              </div>
              
              <div v-if="form.errors.cuisine">
                {{ form.errors.cuisine }}
              </div>
            </div>
            <div class="sm:col-span-3">
              <label
                for="maxReadyTime"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Bereidingstijd</label
              >
              <div class="mt-2">
                <input
                  type="text"
                  v-model="form.maxReadyTime"
                  id="maxReadyTime"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
              </div>
              <div v-if="form.errors.maxReadyTime">
                {{ form.errors.maxReadyTime }}
              </div>
            </div>
            <div class="sm:col-span-3">
              <label
                for="vegetarian"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Vegetarisch</label
              >
              <div class="mt-2">
                <input
                  type="checkbox"
                  v-model="form.vegetarian"
                  id="vegetarian"
                  class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
              </div>
              <div v-if="form.errors.vegetarian">
                {{ form.errors.vegetarian }}
              </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
              <button
                :disabled="form.processing"
                type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
              >
                Save
              </button>
            </div>
          </form>
          <div v-if="recipe">
            <div class="p-4 md:w-1/3">
              <div
                class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden"
              >
                <img
                  class="lg:h-48 md:h-36 w-full object-cover object-center"
                  :src="recipe.image"
                  alt="blog"
                />
                <div class="p-6">
                  <h2
                    class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1"
                  >
                    {{ recipe.dishTypes.join(", ") }}
                  </h2>
                  <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                    {{ recipe.title }}
                  </h1>
                  <p class="leading-relaxed mb-3">
                    {{ recipe.summary.substring(0, 255) }}
                  </p>
                  <div class="flex items-center flex-wrap">
                    <span
                      class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-gray-200"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" class="w-4 h-4 mr-1" version="1.1" id="Capa_1" viewBox="0 0 490 490" xml:space="preserve">
                      <g>
                        <g>
                          <path d="M245,0C109.5,0,0,109.5,0,245s109.5,245,245,245s245-109.5,245-245S380.5,0,245,0z M245,449.3    c-112.6,0-204.3-91.7-204.3-204.3S132.4,40.7,245,40.7S449.3,132.4,449.3,245S357.6,449.3,245,449.3z"/>
                          <path d="M290.9,224.1h-25v-95.9c0-11.5-9.4-20.9-20.9-20.9s-20.9,9.4-20.9,20.9V245c0,11.5,9.4,20.9,20.9,20.9h45.9    c11.5,0,20.9-9.4,20.9-20.9S302.3,224.1,290.9,224.1z"/>
                        </g>
                      </g>
                    </svg>{{ recipe.readyInMinutes }} min
                    </span>
                    <span
                      v-if="recipe.vegetarian"
                      title="Vegetarisch"
                      class="text-gray-400 inline-flex items-center leading-none text-sm"
                    >
                    
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M1.29537 3.70958C0.903482 3.32042 0.901268 2.68726 1.29042 2.29537C1.67958 1.90348 2.31274 1.90127 2.70463 2.29042C6.97479 6.53082 10.2211 11.6174 12.1534 17.7622C12.2982 17.4797 12.4531 17.1888 12.6156 16.8935C12.4852 16.6806 12.3928 16.4395 12.3492 16.1781L12.12 14.8031C11.4138 10.5655 14.1805 6.52668 18.3871 5.65452L19.4769 5.42857C20.566 5.20274 21.6302 5.90904 21.8452 7.00044L22.0882 8.23438C22.9598 12.6595 20.003 16.93 15.5543 17.6715L14.6508 17.822C14.5575 17.8376 14.4647 17.8464 14.3727 17.8489C14.0242 18.4815 13.7197 19.08 13.4836 19.602C13.3121 19.9813 13.1835 20.3056 13.1003 20.5643C13.0589 20.6932 13.0319 20.796 13.016 20.8743C13.0022 20.9429 13.0002 20.9763 12.9999 20.9819C12.9999 20.9825 12.9999 20.9827 12.9999 20.9827L12.9998 20.9819C13.0076 21.4117 12.7399 21.7983 12.3348 21.9423C11.9298 22.0862 11.4781 21.9552 11.213 21.6169L2.39478 10.3669C2.05407 9.93224 2.13024 9.30367 2.56491 8.96297C2.99958 8.62226 3.62814 8.69842 3.96885 9.13309L9.47523 16.158C7.60494 11.309 4.82045 7.21008 1.29537 3.70958ZM15.7104 15.5975C18.7736 14.8266 20.7474 11.7761 20.1259 8.62086L19.8829 7.38692L18.7931 7.61287C15.654 8.26371 13.584 11.2658 14.0851 14.4265C15.0071 12.9857 15.992 11.6292 16.7776 10.8085C17.1595 10.4095 17.7926 10.3957 18.1915 10.7776C18.5905 11.1596 18.6043 11.7926 18.2224 12.1915C17.5417 12.9025 16.6102 14.1834 15.7104 15.5975Z" fill="currentColor"/>
                      </svg>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
