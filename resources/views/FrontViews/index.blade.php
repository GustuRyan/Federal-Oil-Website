<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('sweetalert::alert')

    @vite('resources/css/app.css')
    <title>Workshop Website</title>
</head>

<body>
    <div class="relative w-full" x-data="{ selectedCustomerId: '' }">
        @if (session('scroll'))
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    const element = document.getElementById('customer-data');
                    if (element) {
                        element.scrollIntoView({
                            behavior: 'instant',
                            block: 'start'
                        });
                    }
                });
            </script>
        @endif
        @if (session('invoice_url'))
            <script>
                window.open("{{ session('invoice_url') }}", "_blank");
            </script>
        @endif
        <div class="fixed w-full flex justify-center md:justify-end bottom-0 md:right-0 font-bold z-30 p-4">
            <a href="{{ route('admin.dashboard') }}"
                class="py-2 px-24 md:px-4 bg-bold-blue rounded-full text-2xl md:text-lg text-white text-center md:opacity-50 hover:opacity-100">
                Panel
                Admin
            </a>
        </div>
        <div class="relative">
            <img src="/workshop-hero.png" alt="Hero Image" class="w-full h-screen object-cover">
            <div
                class="absolute left-0 top-0 w-full h-screen bg-gradient-to-r from-[rgba(238,46,69,0.75)] to-[rgba(238,46,69,0.25)] flex items-center justify-end">

                {{-- Queue Card --}}

                <div
                    class="w-fit h-fit bg-light-red mr-24 rounded-lg shadow-lg p-8 md:grid grid-cols-2 gap-x-12 gap-y-16 hidden">
                    <div class="font-bold text-bold-blue">
                        <h1 class="text-2xl">
                            Antrean Sekarang
                        </h1>
                        <div class="flex">
                            <p class="text-[192px] leading-none">
                            </p>
                            <a href="{{ route('ticket.pdf') }}" class="rounded-full bg-primary-green w-10 h-10 flex items-center justify-center">
                                <img src="/icons/icon_print.svg" alt="">
                            </a>
                        </div>
                        <form action="{{ route('user-queue.store') }}" method="POST">
                            @csrf
                            <h2>Keluhan</h2>
                            <textarea type="text" name="issue" class="p-2 rounded-md">{{ $issue ?? 'Keluhan pelanggan (opsional)' }}</textarea>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                    <div class="text-2xl font-bold text-bold-blue w-fit space-y-4">
                        <h1>
                            Daftar Antrean
                        </h1>
                        <div class="overflow-y-scroll scrollbar-hide h-56">
                            <div class="text-5xl space-y-3">
                            </div>
                        </div>
                    </div>
                    <div class="font-bold text-bold-blue w-fit space-y-12">
                        <div class="flex gap-2">
                            <h1 class="text-2xl ">
                                Antrean <br>
                                Selanjutnya
                            </h1>
                            <input id="nextQueueInput" type="number"
                                class="px-2 rounded-md w-28 h-16 text-[64px] leading-none appearance-none border-none outline-none bg-transparent hover:bg-light-blue"
                                value="" readonly />
                        </div>
                        <button id="nextQueue"
                            class="bg-primary-green rounded-lg text-white text-xl font-semibold p-3 hover:opacity-80">
                            Pilih Antrean
                        </button>
                    </div>
                    <div class="text-2xl font-bold text-bold-blue w-fit space-y-5">
                        <h1>
                            Edit Daftar Antrean
                        </h1>
                        <div class="flex flex-col gap-2">
                            <button id="addQueue"
                                class="w-52 bg-bold-blue rounded-lg text-white text-xl font-semibold p-3 hover:opacity-80">
                                Tambah Antrean +
                            </button>
                            <button id="deleteQueue"
                                class="w-52 bg-bold-red rounded-lg text-white text-xl font-semibold p-3 hover:opacity-80">
                                Hapus Antrean -
                            </button>
                        </div>
                    </div>
                </div>

                {{-- End of Queue Card --}}

            </div>
        </div>

        {{-- Customer's Data --}}

        <div id="customer-data" x-data="{ open: false }"
            class="w-full bg-light-red p-12 space-y-8 text-xl font-semibold hidden md:block">
            <!-- Header -->
            <div class="w-full flex justify-between items-center">
                <h1 class="text-3xl font-bold text-bold-blue">
                    Data Pelanggan
                </h1>
                <div class="flex gap-4">
                    <form id="customer-form" action="{{ route('user-queue.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" id="customer-id">

                        <select id="customer-select" class="bg-white rounded-md p-3">
                            <option value="">Pilih Pelanggan</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ $currentCustomer == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    <script>
                        document.getElementById('customer-select').addEventListener('change', function() {
                            let form = document.getElementById('customer-form');
                            let input = document.getElementById('customer-id');
                            input.value = this.value;

                            if (input.value) {
                                form.submit();
                            }
                        });
                    </script>

                    <!-- Tombol untuk membuka form pelanggan baru -->
                    <button @click="open = !open"
                        class="bg-primary-green rounded-md text-xl text-white p-3 hover:opacity-85">
                        Pelanggan Baru
                    </button>
                </div>
            </div>
            @if (session('success'))
                <div id="success-message" class="w-full flex items-center justify-center mb-4">
                    <div class="w-full p-2 rounded-xl shadow-md bg-green-200">
                        <div class="bg-green-200 text-xl font-bold text-green-700 p-4 rounded">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif
            <!-- Form Pelanggan Baru -->
            <form action="{{ route('create.dashboard.customer') }}" method="POST" x-show="open"
                class="transition duration-300 ease-in-out">
                @csrf
                <!-- Form Baris 1 -->
                <div class="grid grid-cols-3 gap-x-12 mt-8">
                    <div class="space-y-2">
                        <label for="name" class="font-bold text-slate-700">Nama *</label>
                        <input id="name" name="name" type="text" placeholder="Masukkan nama customer"
                            class="w-full p-3 rounded-md border-2" required>
                    </div>
                    <div class="space-y-2">
                        <label for="email" class="font-bold text-slate-700">Email *</label>
                        <input id="email" name="email" type="email" placeholder="Masukkan email customer"
                            class="w-full p-3 rounded-md border-2" required>
                    </div>
                    <div class="space-y-2">
                        <label for="address" class="font-bold text-slate-700">Alamat *</label>
                        <textarea id="address" name="address" placeholder="Masukkan alamat customer" class="w-full p-3 rounded-md border-2"
                            required></textarea>
                    </div>
                </div>

                <!-- Form Baris 2 -->
                <div class="grid grid-cols-3 gap-x-12 mt-8">
                    <div class="space-y-2">
                        <label for="phone_number" class="font-bold text-slate-700">Nomor Telepon *</label>
                        <input id="phone_number" name="phone_number" type="text"
                            placeholder="Masukkan nomor telepon" class="w-full p-3 rounded-md border-2" required>
                    </div>
                    <div class="space-y-2">
                        <label for="motorcycle_type" class="font-bold text-slate-700">Tipe Motor *</label>
                        <input id="motorcycle_type" name="motorcycle_type" type="text"
                            placeholder="Masukkan tipe motor" class="w-full p-3 rounded-md border-2" required>
                    </div>
                    <div class="space-y-2">
                        <label for="description" class="font-bold text-slate-700">Deskripsi</label>
                        <textarea id="description" name="description" placeholder="Masukkan deskripsi (opsional)"
                            class="w-full p-3 rounded-md border-2"></textarea>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end mt-8">
                    <button type="submit"
                        class="bg-blue-800 text-white text-xl font-bold py-4 px-6 rounded-lg hover:bg-blue-900 transition duration-300">
                        SIMPAN
                    </button>
                </div>
            </form>
        </div>

        {{-- End of Customer's Data --}}

        @php
            $total_cost = 0;
            $total_service_price = 0;
            $total_product_price = 0;

            foreach ($products as $value) {
                $total_cost = $total_cost + $value->price * $value->amount;
                $total_product_price = $total_cost;
            }
            foreach ($services as $value) {
                $total_cost = $total_cost + $value->price;
                $total_service_price = $total_service_price + $value->price;
            }
        @endphp

        {{-- Vehicle's Data --}}

        <div class="p-12 md:flex flex-col lg:flex-row justify-between space-y-12 lg:space-y-0  hidden">

            <div class="space-y-12 w-full">
                <livewire:cashier-table :type="'service'" :items="$services" :sub_total="$total_service_price" />

                <livewire:cashier-table :items="$products" :sub_total="$total_product_price" />
            </div>

            @include('frontviews.components.transaction-detail', [
                'total_cost' => $total_cost,
                'customer_id' => $currentCustomer,
            ])
        </div>

        {{-- End of Vehicle's Data --}}

    </div>

    <script>
        // Mengambil elemen select
        const customerSelect = document.getElementById('customer-select');

        // Event listener untuk menangkap perubahan
        customerSelect.addEventListener('change', function() {
            const selectedCustomerId = customerSelect.value;

            // Update elemen input atau teks di dalam komponen
            const customerInput = document.getElementById('customer-id-input');
            if (customerInput) {
                customerInput.value = selectedCustomerId; // Set value ke input
            }

            const customerText = document.getElementById('customer-id-text');
            if (customerText) {
                customerText.textContent = selectedCustomerId || 'Belum Dipilih'; // Update teks
            }
        });
    </script>

    <script>
        let currentQueueData = null;

        async function fetchQueueData() {
            try {
                const response = await fetch('/queue/get');
                const data = await response.json();

                if (response.ok && data) {
                    if (!data.queue_list || data.queue_list.length === 0) {
                        currentQueueData = {
                            queue_list: [1],
                            current_queue: 1,
                            last_queue: 1,
                        };
                        document.querySelector('.font-bold.text-bold-blue p').textContent = '01';
                        document.querySelector('.overflow-y-scroll .text-5xl').innerHTML = '';
                    } else {
                        currentQueueData = data;

                        // Menampilkan current_queue dengan format dua digit
                        const formattedCurrentQueue = currentQueueData.current_queue
                            .toString()
                            .padStart(2, '0');

                        document.querySelector('.font-bold.text-bold-blue p').textContent = formattedCurrentQueue;

                        const queueListContainer = document.querySelector('.overflow-y-scroll .text-5xl');
                        queueListContainer.innerHTML = "";

                        currentQueueData.queue_list.forEach(queue => {
                            if (queue != currentQueueData.current_queue) {
                                const queueItem = document.createElement('p');
                                queueItem.textContent = queue.toString().padStart(2,
                                    '0');
                                queueListContainer.appendChild(queueItem);
                            }
                        });
                    }

                    initializeNextQueueInput(currentQueueData);
                }
            } catch (error) {
                console.error('Gagal mengambil data antrean:', error);
            }
        }

        function initializeNextQueueInput(queueData) {
            const nextQueueInput = document.getElementById('nextQueueInput');

            if (queueData.queue_list.length <= 1) {
                nextQueueInput.value = queueData.queue_list[0].toString().padStart(2, '0');
                nextQueueInput.setAttribute('readonly', true);
            } else {
                const nextQueue = queueData.current_queue + 1;

                if (queueData.queue_list.includes(nextQueue)) {
                    nextQueueInput.value = nextQueue.toString().padStart(2, '0');
                    nextQueueInput.removeAttribute('readonly');
                } 
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchQueueData();
        });

        async function addQueue() {
            if (!currentQueueData) {
                alert('Data antrean belum dimuat.');
                return;
            }

            // Ambil antrean terakhir dan tambah satu
            const lastQueue = currentQueueData.last_queue + 1;
            currentQueueData.queue_list.push(lastQueue);

            updateQueueOnServer(lastQueue);
        }

        async function deleteQueue() {
            if (!currentQueueData || currentQueueData.queue_list.length === 0) {
                alert('Tidak ada antrean untuk dihapus.');
                return;
            }

            currentQueueData.queue_list.pop();
            const lastQueue = currentQueueData.last_queue - 1;
            updateQueueOnServer(lastQueue);
        }

        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        async function updateQueueOnServer(lastQueue) {
            try {
                // Tentukan URL dan metode berdasarkan apakah currentQueueData.id ada
                const url = currentQueueData.id ? `/queues/update/${currentQueueData.id}` : '/queues/store';
                const method = currentQueueData.id ? 'PUT' :
                    'POST'; // Jika id ada, gunakan PUT, jika tidak, gunakan POST

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        queue_list: currentQueueData.queue_list,
                        last_queue: lastQueue,
                    }),
                });

                if (response.ok) {
                    alert('Antrean berhasil diperbarui');
                    fetchQueueData(); 
                } else {
                    const errorData = await response.json();
                    console.error('Gagal memperbarui antrean:', errorData);
                    alert(`Gagal memperbarui antrean: ${errorData.message || errorData.error || 'Unknown error'}`);
                }
            } catch (error) {
                console.error('Error saat memperbarui antrean:', error);
                alert('Error saat memperbarui antrean.');
            }
        }

        function nextQueue() {
            const nextQueueInput = document.getElementById('nextQueueInput');
            const currentInputValue = parseInt(nextQueueInput.value, 10);

            if (isNaN(currentInputValue)) {
                alert('Nilai input tidak valid.');
                return;
            }

            const newQueue = currentInputValue;
            console.log('Antrean berikutnya:', newQueue);

            updateCurrentQueue(newQueue, currentQueueData.queue_list);
        }

        async function updateCurrentQueue(newQueue, newList) {
            try {
                const url = `/queues/current/${currentQueueData.id}`;
                const method = 'PUT';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        current_queue: newQueue,
                        queue_list: newList,
                    }),
                });

                if (response.ok) {
                    alert('Antrean berhasil diperbarui');
                    fetchQueueData();
                    location.reload();
                } else {
                    const errorData = await response.json();
                    console.error('Gagal memperbarui antrean:', errorData);
                    alert(`Gagal memperbarui antrean: ${errorData.message || errorData.error || 'Unknown error'}`);
                }
            } catch (error) {
                console.error('Error saat memperbarui antrean:', error);
                alert('Error saat memperbarui antrean.');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchQueueData();

            document.querySelector('#addQueue').addEventListener('click', addQueue);
            document.querySelector('#deleteQueue').addEventListener('click', deleteQueue);
            document.querySelector('#nextQueue').addEventListener('click', nextQueue);
        });

        setTimeout(function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.style.top = '-200px';
            }

            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 3000);
    </script>

</body>

</html>
