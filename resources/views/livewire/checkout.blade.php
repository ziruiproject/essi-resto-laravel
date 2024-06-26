<section class="relative flex flex-col min-h-screen">
    <div class="gap-y-2 grid grid-cols-2">
        <div>
            <span class="text-black">Current Orders</span>
            <h1 class="text-2xl font-bold text-black">{{ '#' . $orderId }}</h1>
        </div>
        <div class="text-end">
            <span class="text-black">Table No</span>
            <h1 class="text-2xl font-bold text-black">{{ '#' . $table }}</h1>
        </div>
        <div>
            <span class="text-black">Total Price</span>
            <h1 class="text-2xl font-bold text-black">{{ Number::currency($total, 'IDR', 'id') }}</h1>
        </div>
        <div class="text-end">
            <span class="text-black">Amount</span>
            <h1 class="text-2xl font-bold text-black">{{ $amount }}</h1>
        </div>
    </div>
    <div class="bg-background grid grid-cols-1 pt-4 divide-y">
        @foreach ($carts as $item)
            <div class="gap-x-4 flex py-3">
                <div class="bg-orange-shade min-w-max h-fit rounded-2xl p-2">
                    <img class="aspect-square h-16 rounded-full" src="{{ asset('storage/' . $item->image) }}"
                        alt="">
                </div>
                <div class="flex flex-col w-full">
                    <span class="text-xl font-semibold text-black">{{ $item->name }}</span>
                    <span
                        class="text-lg font-medium text-black">{{ Number::currency($item->price, 'IDR', 'id') }}</span>
                    <span class="py-2 font-light text-black">{{ 'Amount: ' . $item->amount }}</span>
                </div>
            </div>
        @endforeach
        <div
            class="gap-y-2 shadow-full rounded-t-3xl fixed bottom-0 left-0 flex flex-col w-full p-4 pt-8 bg-white border-none">
            <button id="pay-button"
                class="rounded-3xl bg-yellow-300 w-full py-3 text-lg font-bold text-center text-white shadow-md">
                Bayar
            </button>
        </div>
    </div>
</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    document.getElementById('pay-button').onclick = function() {
        // SnapToken acquired from previous step
        snap.pay('{{ $snapToken }}', {
            // Optional
            onSuccess: function(result) {
                window.location.href =
                    '{{ route('transaction.success', ['id' => $orderId]) }}'
            },
            // Optional
            onPending: function(result) {},
            // Optional
            onError: function(result) {
                window.location.href =
                    '{{ route('transaction.failed', ['id' => $orderId]) }}'
            }
        });
    };
</script>
