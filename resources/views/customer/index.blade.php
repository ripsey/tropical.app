<x-app-layout>
    @if ($message = Session::get('success'))
    <div class="bg-gray-400 text-white p-4 mb-4 shadow sm:rounded-lg">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h1 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">
                Klanten
            </h1>
            <div class="flex gap-4">
                <x-text-input id="searchInput" name="searchInput" type="text" class="block w-full" autofocus placeholder="Zoeken.." />
                <a href="{{ route('customer.create') }}" class="inline-flex items-center px-4 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 hover:text-teal-500"><span class="material-icons">person_add</span></a>
            </div>
            <div class="overflow-auto">
                <table class="w-full mt-4" id="customerTable">
                    <thead class="bg-white border-b-2 border-gray-400">
                        <tr>
                            <th class="py-1 px-2 text-left font-semibold">Naam</th>
                            <th class="py-1 px-2 text-left font-semibold">Telefoon</th>
                            <th class="py-1 px-2 text-left font-semibold">Woonplaats</th>
                        </tr>
                    </thead>
                    <tbody class="bg-slate-100">
                        @foreach ($customers as $customer)
                        <tr class="hover:bg-slate-600 hover:text-white even:bg-slate-200 cursor-pointer" data-url="{{ route('customer.show', $customer->id) }}">
                            <td class="py-1 px-2">{{ $customer->firstname }} {{ $customer->lastname }}</td>
                            <td class="py-1 px-2">{{ (!empty($customer->mobile)) ? $customer->mobile : $customer->phone }}</td>
                            <td class="py-1 px-2">{{ $customer->city }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const rows = document.querySelectorAll('.cursor-pointer');
        rows.forEach(row => {
            row.addEventListener('click', () => {
                const url = row.dataset.url;
                if (url) {
                    window.location.href = url;
                }
            });
        });
        const search_input = document.getElementById("searchInput")
        search = () => {
            let val = search_input.value.trim();
            let opts = document.getElementById('customersDataList').childNodes;
            for (let i = 0; i < opts.length; i++) {
                if (opts[i].value === val) {
                    location.href = "/customer/" + opts[i].dataset.id;
                    break;
                }
            }
        }
        filterTable = () => {
            let filter = search_input.value.toUpperCase().trim();
            let searchWords = filter.split(" ");
            let table = document.getElementById("customerTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                let displayRow = searchWords.every(searchWord => {
                    return Array.from(cells).some(cell => {
                        let txtValue = cell.textContent || cell.innerText;
                        return txtValue.toUpperCase().indexOf(searchWord) > -1;
                    });
                });

                rows[i].style.display = displayRow ? "" : "none";
            }
        }
        search_input.addEventListener('input', search)
        search_input.addEventListener('keyup', filterTable)
    </script>
</x-app-layout>