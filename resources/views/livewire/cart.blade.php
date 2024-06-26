<section class="relative flex flex-col min-h-screen">
    <h1 class="text-2xl font-bold text-black">Cart</h1>
    <div class="gap-y-2 flex flex-col">
        <form action="" class="gap-y-2 flex flex-col">
            <div class="flex flex-col">
                <label for="dine">Where to Eat</label>
                <select wire:model.change="dine" name="dine" id="dine"
                    class="bg-yellow-50 rounded-xl focus:outline-none p-2">
                    <option value="0">Dine In</option>
                    <option value="1">Take Away</option>
                </select>
            </div>

            @if ($dine == '0')
                <div class="flex flex-col">
                    <label for="table" id="label-table">Choose Table</label>
                    <select wire:model.change="table" name="table" id="table"
                        class="bg-yellow-50 rounded-xl focus:outline-none p-2">
                        @foreach ($tables as $table)
                            <option value="{{ $table->id }}">{{ 'No ' . $table->id }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </form>
    </div>
    <div class="bg-background grid grid-cols-1 divide-y">
        @foreach ($carts as $item)
            <div class="gap-x-4 flex py-3">
                <div class="bg-yellow-50 min-w-max h-fit rounded-2xl p-2">
                    <img class="aspect-square h-16 rounded-full" src="{{ asset('storage/' . $item->image) }}"
                        alt="">
                </div>
                <div class="flex flex-col w-full">
                    <span class="text-xl font-semibold text-black">{{ $item->name }}</span>
                    <span
                        class="text-lg font-medium text-black">{{ Number::currency($item->price, 'IDR', 'id') }}</span>
                    <div class="w-fit gap-x-2 flex self-start">
                        <button wire:click="min({{ $item->id }})">
                            <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px"
                                class="fill-yellow-300" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" color="#ec7905" stroke-width="1.5">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM8 11.25C7.58579 11.25 7.25 11.5858 7.25 12C7.25 12.4142 7.58579 12.75 8 12.75H16C16.4142 12.75 16.75 12.4142 16.75 12C16.75 11.5858 16.4142 11.25 16 11.25H8Z">
                                </path>
                            </svg>
                        </button>
                        <span class="py-2 text-xl font-bold text-center">{{ $item->amount }}</span>
                        <button wire:click="add({{ $item->id }})">
                            <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px"
                                class="fill-yellow-300" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" color="#ec7905" stroke-width="1.5">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM12.75 8C12.75 7.58579 12.4142 7.25 12 7.25C11.5858 7.25 11.25 7.58579 11.25 8V11.25H8C7.58579 11.25 7.25 11.5858 7.25 12C7.25 12.4142 7.58579 12.75 8 12.75H11.25V16C11.25 16.4142 11.5858 16.75 12 16.75C12.4142 16.75 12.75 16.4142 12.75 16V12.75H16C16.4142 12.75 16.75 12.4142 16.75 12C16.75 11.5858 16.4142 11.25 16 11.25H12.75V8Z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="gap-y-2 shadow-full rounded-t-3xl fixed bottom-0 left-0 flex flex-col w-full p-4 pt-8 bg-white">
        <span id="total" class="text-xl font-medium text-black">Total =
            {{ Number::currency($total, 'IDR', 'id') }}
        </span>
        <form method="post" action="{{ route('transaction.create') }}">
            @csrf
            <input type="text" name="table" wire:model.live='table' class="hidden">
            <input type="text" name="total" wire:model.live='total' class="hidden">
            <button type="submit" id="total-amount"
                class="rounded-3xl bg-yellow-300 w-full py-3 text-lg font-bold text-center text-white shadow-md">
                Checkout
            </button>
        </form>
    </div>
</section>
