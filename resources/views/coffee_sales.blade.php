<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200 flex flex-col" x-data="coffeeData()" x-init="fetch('api/sales').then(response => response.json()).then(data => sales = data)">

                    <div class="text-red-600" x-show="showError" x-text="errorMessage"></div>

                    <div class="flex flex-row justify-between mb-8">
                        <div class="flex flex-row">
                            <div class="mr-8">
                                <label class="block" for="coffee">Product</label>
                                <select class="form-control" id="coffee" x-model="selectedCoffeeId">
                                    <option value="">Select Coffee</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mr-8">
                                <label class="block" for="quantity">Quantity</label>
                                <input type="number" class="block" id="quantity" min="0" step="1" x-model="quantity" oninput="validity.valid||(value='');" @change="showError=false" />
                            </div>
                            <div>
                                <label class="block" for="unit_cost">Unit Cost (£)</label>
                                <input type="text" class="block" id="unit_cost" x-model="unitCost" @change="showError=false" />
                            </div>
                        </div>
                        <div>
                            <div>Selling Price</div>
                            <div x-text="calculatedSalePrice"></div>
                        </div>
                        <div>
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                @click="fetch('api/sales/store', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        quantity: parseInt(quantity),
                                        unit_cost: unitCost * 100,
                                        coffee_id: parseInt(selectedCoffeeId)
                                    })
                                }).then(response => {
                                    if (response.ok) {
                                        fetch('api/sales').then(response => response.json()).then(data => {
                                            sales = data;
                                            unitCost = '';
                                            quantity = '';
                                        });
                                    }
                                    else {
                                        displayError('Please ensure the quantity is a whole number and the unit cost is a number or decimal with no currency symbol')
                                    }
                                })"
                            >
                                Record Sale
                            </button>
                        </div>
                    </div>

                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Previous Sales</h2>
                        <table class="w-1/2 border-collapse border border-slate-500">
                            <thead>
                            <tr>
                                <th class="border border-slate-600 text-center">Product</th>
                                <th class="border border-slate-600 text-center">Quantity</th>
                                <th class="border border-slate-600 text-center">Unit Cost</th>
                                <th class="border border-slate-600 text-center">Selling Price</th>
                                <th class="border border-slate-600 text-center">Sold At</th>
                            </tr>
                            </thead>
                            <template x-if="sales.length">
                                <tbody>
                                <template
                                    x-for="sale in sales"
                                    :key="sale.id"
                                >
                                    <tr>
                                        <td class="border border-slate-700 text-center" x-text="sale.coffee.name"></td>
                                        <td class="border border-slate-700 text-center" x-text="sale.quantity"></td>
                                        <td class="border border-slate-700 text-center" x-text="formatCurrency(sale.unit_cost)"></td>
                                        <td class="border border-slate-700 text-center" x-text="formatCurrency(sale.sale_price)"></td>
                                        <td class="border border-slate-700 text-center" x-text="formatCurrency(sale.sold_at)"></td>
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
            selectedCoffeeId: '',
            coffees: {!! json_encode($items) !!},
            shippingCost: {!! $shippingCost !!},
            selectedCoffee: null,
            sales: [],
            unitCost: '',
            quantity: '',
            errorMessage: '',
            showError: false,
            formatCurrency(value) {
                return (value).toLocaleString('en-GB', {
                    style: 'currency',
                    currency: 'GBP',
                });
            },
            get calculatedSalePrice() {
                if (this.profitMargin && this.unitCost && !isNaN(this.unitCost) && this.quantity && !isNaN(this.quantity)) {
                    const salePrice = Math.ceil((this.quantity * this.unitCost * 100) / (1-(this.profitMargin/100)) + this.shippingCost)/100;
                    return this.formatCurrency(salePrice);
                }
                return 'N/A';
            },
            get profitMargin() {
                if (this.selectedCoffeeId) {
                    // Get the profit margin from the list of coffees
                    const coffee = this.coffees.find(element => element.id === parseInt(this.selectedCoffeeId));
                    if (coffee) {
                        return coffee.profit_margin;
                    }
                }
                return '';
            },
            displayError(message) {
                this.errorMessage = message;
                this.showError = true;
            },
        }
    }

</script>
