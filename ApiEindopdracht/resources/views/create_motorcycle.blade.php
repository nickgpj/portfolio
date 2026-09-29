<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Motor aanmaken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Nieuwe Motor</h1>
                    <div id="create-motorcycle-app">
                        <form @submit.prevent="createMotorcycle" class="mb-8">
                            @csrf
                            <div v-if="formError" class="text-red-500 mb-2">@{{ formError }}</div>
                            <div v-if="formSuccess" class="text-green-500 mb-2">@{{ formSuccess }}</div>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Merk:</label>
                                    <input v-model="form.brand" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required maxlength="50">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Model:</label>
                                    <input v-model="form.model" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required maxlength="50">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Bouwjaar:</label>
                                    <input v-model="form.year" type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required min="1900" :max="currentYear">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Aantal PK:</label>
                                    <input v-model="form.horsepower" type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required min="12" max="500">
                                </div>
                            </div>
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('motorcycles') }}" class="block p-2 rounded-xl bg-red-500 text-white hover:bg-red-600">Annuleren</a>
                                <button type="submit" class="p-2 bg-green-500 text-white rounded-xl hover:bg-green-600">Aanmaken</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Vue.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js"></script>
<script>
const { createApp } = Vue;
createApp({
    data() {
        return {
            form: {
                brand: '',
                model: '',
                year: '',
                horsepower: ''
            },
            formError: '',
            formSuccess: '',
            currentYear: new Date().getFullYear()
        };
    },
    methods: {
        createMotorcycle() {
            this.formError = '';
            this.formSuccess = '';
            fetch('/api/motorcycles', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(this.form)
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) {
                    if (data.errors) {
                        this.formError = Object.values(data.errors).flat().join(' ');
                    } else {
                        this.formError = data.message || 'Failed to create motorcycle.';
                    }
                    throw new Error(this.formError);
                }
                this.formSuccess = 'Motor succesvol toegevoegd!';
                this.form = { brand: '', model: '', year: '', horsepower: '' };
            })
            .catch(err => {
                
            });
        }
    }
}).mount('#create-motorcycle-app');
</script>
