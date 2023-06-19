<x-app-layout>
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h1 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">
                Archief
            </h1>
            <section class="mytabs shadow-lg">
                <input type="radio" id="tabcustomers" name="mytabs" checked="checked" />
                <label for="tabcustomers">Klanten</label>
                <div class="tab">
                    <div class="overflow-auto">
                        <table class="w-full mt-4">
                            <thead class="bg-white border-b-2 border-gray-400">
                                <tr>
                                    <th class="py-1 px-2 text-left font-semibold">Naam</th>
                                    <th class="py-1 px-2 text-left font-semibold">Email</th>
                                    <th class="py-1 px-2 text-left font-semibold">Telefoon</th>
                                    <th class="py-1 px-2 text-left font-semibold">Actie</th>
                                </tr>
                            </thead>
                            <tbody class="bg-slate-100">
                                @foreach ($customers as $customer)
                                <tr class="hover:bg-slate-600 hover:text-white even:bg-slate-200">
                                    <td class="py-1 px-2">{{ $customer->firstname }} {{ $customer->lastname }}</td>
                                    <td class="py-1 px-2">{{ $customer->email }}</td>
                                    <td class="py-1 px-2">{{ (!empty($customer->mobile)) ? $customer->mobile : $customer->phone }}</td>
                                    <td class="py-1 px-2"><a href="{{ route('customer.restore', $customer->id) }}" title="Restore"><span class="material-icons">restore</span></a></td>
                                </tr>
                                @endforeach
                                @if ($customers->isEmpty())
                                <tr>
                                    <td class="py-1 px-2" colspan="4">Geen klanten gevonden.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>