<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Set new shipment cost 🚚') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200 flex flex-col" x-data="coffeeData()" x-init="fetch('api/shipping-costs').then(response => response.json()).then(data => shippingCosts = data)">

                    <div class="text-red-600" x-show="showError" x-text="errorMessage"></div>

                    <div class="flex flex-row justify-between mb-8">
                        <div class="flex flex-row">
                            <div>
                                <label class="block" for="unit_cost">Shipping Cost (£)</label>
                                <input type="text" class="block" id="shipping_cost" x-model="newShippingCost" @change="showError=false" />
                            </div>
                        </div>
                        <div>
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                @click="fetch('api/shipping-costs/store', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        shipping_cost: newShippingCost * 100
                                    })
                                }).then(response => {
                                    if (response.ok) {
                                        fetch('api/shipping-costs').then(response => response.json()).then(data => {
                                            shippingCosts = data;
                                            newshippingCost = '';
                                        });
                                    }
                                    else {
                                        displayError('Please ensure the quantity is a whole number or decimal with no currency symbol')
                                    }
                                })"
                            >
                                Set New Price
                            </button>
                        </div>
                    </div>

                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Log Of Shipment Costs</h2>
                        <table class="w-1/2 border-collapse border border-slate-500">
                            <thead>
                            <tr>
                                <th class="border border-slate-600 text-center">Shipment Cost</th>
                                <th class="border border-slate-600 text-center">Active</th>
                                <th class="border border-slate-600 text-center">Set At</th>
                                <th class="border border-slate-600 text-center">Number Of Sales</th>
                            </tr>
                            </thead>
                            <template x-if="shippingCosts.length">
                                <tbody>
                                <template
                                    x-for="(shippingCost, index) in shippingCosts"
                                    :key="shippingCost.id"
                                >
                                    <tr>
                                        <td class="border border-slate-700 text-center" x-text="formatCurrency(shippingCost.shipping_cost)"></td>
                                        <template x-if="index === 0">
                                            <td class="border border-slate-700 text-center" x-text="'Yes'"></td>
                                        </template>
                                        <template x-if="index !== 0">
                                            <td class="border border-slate-700 text-center" x-text="'No'"></td>
                                        </template>
                                        <td class="border border-slate-700 text-center" x-text="shippingCost.set_at"></td>
                                        <td class="border border-slate-700 text-center" x-text="shippingCost.sales_count"></td>
                                    </tr>
                                </template>
                                </tbody>
                            </template>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function coffeeData() {
        return {
            newShippingCost: '',
            shippingCost: {!! $shippingCost !!},
            shippingCosts: [],
            errorMessage: '',
            showError: false,
            formatCurrency(value) {
                return (value).toLocaleString('en-GB', {
                    style: 'currency',
                    currency: 'GBP',
                });
            },
            displayError(message) {
                this.errorMessage = message;
                this.showError = true;
            },
        }
    }

</script>
