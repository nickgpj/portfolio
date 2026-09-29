<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Motoren API') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center mb-4 gap-5">
                    <h1 class="text-2xl font-bold items-center">Motoren</h1>
                    <a href="{{ route('motorcycles.create') }}" class="block bg-green-500 text-white font-bold p-2 rounded-xl hover:bg-green-600">Nieuwe motor</a>
                    </div>
                    <div id="motorcycles-app">
                        <div v-if="loading" class="text-gray-500">Motoren laden...</div>
                        <div v-else>
                            <div v-if="error" class="text-red-500 mb-4">@{{ error }}</div>
                            <div v-if="motorcycles.length === 0" class="text-gray-500">Geen motoren gevonden.</div>
                            <div v-else>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merk</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bouwjaar</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aantal PK</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="m in motorcycles" :key="m.id">
                                            <template v-if="editId === m.id">
                                                <td class="px-6 py-4 whitespace-nowrap"><input v-model="editForm.brand" type="text" class="border rounded px-2 w-full" maxlength="50"></td>
                                                <td class="px-6 py-4 whitespace-nowrap"><input v-model="editForm.model" type="text" class="border rounded px-2 w-full" maxlength="50"></td>
                                                <td class="px-6 py-4 whitespace-nowrap"><input v-model="editForm.year" type="number" class="border rounded px-2 w-full" min="1900" :max="currentYear"></td>
                                                <td class="px-6 py-4 whitespace-nowrap"><input v-model="editForm.horsepower" type="number" class="border rounded px-2 w-full" min="12" max="500"></td>
                                                <td colspan="3">
                                                    <button @click="saveEdit(m.id)" class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 mr-2">Opslaan</button>
                                                    <button @click="cancelEdit" class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">Annuleren</button>
                                                    <div v-if="editError" class="text-red-500 mt-2">@{{ editError }}</div>
                                                </td>
                                            </template>
                                            <template v-else>
                                                <td class="px-6 py-4 whitespace-nowrap">@{{ m.brand }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">@{{ m.model }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">@{{ m.year }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">@{{ m.horsepower }}</td>
                                                <td class="px-6 py-4 flex gap-5">
                                                    <button @click="startEdit(m)" class="py-2 p-2 rounded-xl bg-yellow-500 text-white hover:bg-yellow-600">Wijzigen</button>
                                                    <button @click="deleteMotorcycle(m.id)" class="py-2 p-2 rounded-xl bg-red-500 text-white hover:bg-red-700">Verwijderen</button>
                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- vue package -->
<script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js"></script>
<script>
const { createApp } = Vue;
//app aanmaken
createApp({
    //data meegeven
    data() {
        return {
            motorcycles: [],
            loading: true,
            error: '',
            editId: null,
            editForm: {
                brand: '',
                model: '',
                year: '',
                horsepower: ''
            },
            editError: '',
            currentYear: new Date().getFullYear()
        };
    },
    //data weergeven bij laden
    mounted() {
        this.fetchMotorcycles();
    },
    methods: {
        fetchMotorcycles() {
            this.loading = true;
            fetch('/api/motorcycles')
                .then(res => {
                    if (!res.ok) throw new Error('Failed to fetch motorcycles');
                    return res.json();
                })
                .then(data => {
                    this.motorcycles = data.data || [];
                })
                .catch(err => {
                    this.error = err.message;
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        //edit
        startEdit(motorcycle) {
            this.editId = motorcycle.id;
            this.editForm = { ...motorcycle };
            this.editError = '';
        },
        cancelEdit() {
            this.editId = null;
            this.editForm = { brand: '', model: '', year: '', horsepower: '' };
            this.editError = '';
        },
        saveEdit(id) {
            this.editError = '';
            fetch(`/api/motorcycles/${id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(this.editForm)
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) {
                    if (data.errors) {
                        this.editError = Object.values(data.errors).flat().join(' ');
                    } else {
                        this.editError = data.message || 'Wijzigen mislukt.';
                    }
                    throw new Error(this.editError);
                }
                const idx = this.motorcycles.findIndex(m => m.id === id);
                if (idx !== -1 && data.motorcycle && data.motorcycle.data) {
                    this.motorcycles[idx] = data.motorcycle.data;
                }
                this.cancelEdit();
            })
        },
        //delete
        deleteMotorcycle(id) {
            if (!confirm('Weet je zeker dat je deze motor wilt verwijderen?')) return;
            fetch(`/api/motorcycles/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) {
                    this.error = data.message || 'Failed to delete motorcycle.';
                    throw new Error(this.error);
                }
                this.motorcycles = this.motorcycles.filter(m => m.id !== id);
            })
        },
    }
    //createApp uitvoeren
}).mount('#motorcycles-app');
</script>
