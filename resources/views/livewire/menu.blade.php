<section class="w-full">
    <div class="w-full mb-4 flex gap-x-2">
        <input
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-200"
            type="text" wire:model.live="search" placeholder="Search Menu...">
        <a href="{{ route('show.cart') }}"
            class="bg-yellow-300 hover:bg-yellow-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
        </a>
    </div>
    <div
        class="grid grid-cols-1 md:grid-cols-4 gap-4 justify-center items-center place-content-center place-items-center p-4">
        @foreach ($menu as $item)
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                <a href="{{ route('show.menu', ['id' => $item->id]) }}">
                    <img class="p-8 rounded-t-lg" src="{{ asset('storage/' . $item->image) }}"
                        alt="{{ Str::slug($item->name) }}" />
                </a>
                <div class="px-5 pb-5">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900">
                        {{ $item->name }}
                    </h5>
                    <div class="flex flex-col justify-between gap-y-4">
                        <span
                            class="text-3xl font-bold text-gray-900">{{ Number::currency($item->price, 'IDR', 'id') }}</span>
                        <form method="post" action="{{ route('store.cart') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="amount" value="1">
                            <button type="submit"
                                class="w-full bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Add to cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
