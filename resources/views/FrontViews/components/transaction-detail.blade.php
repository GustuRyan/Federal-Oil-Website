@php
    use Carbon\Carbon;
    use App\Models\Queue;

    $queue = Queue::whereDate('created_at', Carbon::now())->first() ?? new Queue(['id' => 1]);
    $invoiceNum = 'INV-' . Carbon::now()->format('Ymd') . '0' . $queue->current_queue;
@endphp
<div class="w-full lg:w-[36%]">
    <form id="checkoutForm" action="{{ route('create.transaction') }}"
        class="bg-light-blue rounded-xl shadow-lg w-full text-lg" method="POST">
        @csrf
        <div class="space-y-4 p-6">
            <input type="hidden" id="customer-id-input" name="customer_id" value="{{ $customer_id }}">
            <input type="hidden" id="customer-id-input" name="invoice" value="{{ $invoiceNum }}">
            <div class="w-full pb-3 border-b-[3px] border-[#C3C1C7] text-bold-blue text-2xl font-bold">
                Detail Transaksi
            </div>
            <div class="space-y-2">
                <h2 class="text-xl font-semibold text-bold-blue">
                    Metode Pembayaran
                </h2>
                <div class="w-full rounded-xl shadow-md flex justify-between p-3 bg-white">
                    <select name="payment_methods" id="" class="w-full">
                        <option value="tunai">
                            Tunai
                        </option>
                        <option value="kredit">
                            Kredit
                        </option>
                        <option value="transfer">
                            Transfer
                        </option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <h2 class="text-xl font-semibold text-bold-blue">
                    Status
                </h2>
                <div class="w-full rounded-xl shadow-md flex justify-between p-3 bg-white">
                    <select name="payment_status" id="" class="w-full">
                        <option value="lunas">
                            Lunas
                        </option>
                        <option value="belum lunas">
                            Belum Lunas
                        </option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <h2 class="text-xl font-semibold text-bold-blue">
                    Keterangan (Keluhan)
                </h2>
                <div class="w-full rounded-xl shadow-md flex justify-between bg-white">
                    <textarea name="description" id="" class="w-full h-28 p-3 rounded-xl"
                        placeholder="masukan keterangan service disini... (opsional)"></textarea>
                </div>
            </div>
            <div class="w-full h-[3px] bg-[#C3C1C7]"></div>
            <div class="space-y-3">
                <h2 class="text-xl font-semibold text-bold-blue">
                    Total Biaya Transaksi
                </h2>
                <div class="w-full rounded-xl shadow-md justify-between bg-white space-y-3 p-3">
                    <div class="flex justify-between">
                        <p>Sub Total</p>
                        <p>Rp. {{ number_format($total_cost, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-full h-[2px] bg-[#E6E6E6]"></div>
                    <div class="space-y-1">
                        <div class="w-full flex justify-between">
                            <h2 class="font-bold text-bold-blue">Total Keseluruhan</h2>
                            <p id="totalKeseluruhan">Rp.
                                {{ number_format($total_cost, 0, ',', '.') }}</p>
                            <input type="hidden" name="total_cost" value="{{ $total_cost }}">
                        </div>
                        <div class="w-full flex justify-between">
                            <h2 class="font-semibold text-bold-blue">Jumlah Bayar</h2>
                            <input type="number" id="jumlahBayar" class="border rounded p-1 w-1/3 text-right"
                                placeholder="input disini" oninput="hitungKembalian()" />
                        </div>
                        <div class="w-full flex justify-between">
                            <h2 class="font-semibold text-bold-blue">Kembalian</h2>
                            <p id="kembalian">Rp. 0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-b-lg flex justify-end">
            <button type="submit" class="rounded-xl bg-primary-green text-white font-semibold p-3 hover:opacity-85">
                Checkout
            </button>
        </div>
    </form>
</div>
<script>
    function hitungKembalian() {
        const totalKeseluruhan = {{ $total_cost }};
        const jumlahBayar = parseInt(document.getElementById('jumlahBayar').value) || 0;
        const kembalian = jumlahBayar - totalKeseluruhan;

        const kembalianElement = document.getElementById('kembalian');
        kembalianElement.textContent = `Rp. ${new Intl.NumberFormat('id-ID').format(kembalian > 0 ? kembalian : 0)}`;
    }
</script>
