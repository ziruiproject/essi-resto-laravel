<section class="bg-background flex justify-center min-h-screen">
    <div class="gap-y-4 grid grid-cols-1 md:grid-cols-2 gap-x-8">
        <img class="aspect-square rounded-3xl" src="{{ asset('storage/' . $food->image) }}" alt="">
        <div class="gap-y-4 flex flex-col">
            <div class="flex flex-col items-start justify-between align-middle gap-y-2">
                <h3 class="text-3xl font-bold">{{ $food->name }}</h3>
                <span class=" text-yellow-300 text-xl font-bold">{{ Number::currency($food->price, 'IDR', 'id') }}</span>
            </div>
            <div class="gap-y-2 flex flex-col">
                <span class="font-bold">Categories</span>
                <div class="grid grid-cols-5 gap-3">
                    @foreach ($categories as $category)
                        <span
                            class="bg-yellow-300 rounded-3xl min-w-fit text-yellow-300-shade px-3 py-2 text-sm text-center">{{ $category->name }}
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="gap-y-1 flex flex-col">
                <span class="font-bold text-black">Description</span>
                <p class="text-darker-gray pb-4 font-light">{!! $food->description !!}</p>
            </div>
            <div class="flex items-center justify-between align-middle">
                <span class="text-xl font-bold">Amount</span>
                <div class="w-fit gap-x-2 flex items-center self-center justify-center">
                    <button wire:click="min">
                        <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px" viewBox="0 0 24 24"
                            class="fill-yellow-300" fill="none" xmlns="http://www.w3.org/2000/svg"
                            stroke-width="1.5">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM8 11.25C7.58579 11.25 7.25 11.5858 7.25 12C7.25 12.4142 7.58579 12.75 8 12.75H16C16.4142 12.75 16.75 12.4142 16.75 12C16.75 11.5858 16.4142 11.25 16 11.25H8Z">
                            </path>
                        </svg>
                        </svg>
                    </button>
                    <span id="amount" class="py-2 text-xl font-bold text-center">{{ $count }}</span>
                    <button wire:click="add">
                        <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px" viewBox="0 0 24 24"
                            class="fill-yellow-300" fill="none" xmlns="http://www.w3.org/2000/svg"
                            stroke-width="1.5">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM12.75 8C12.75 7.58579 12.4142 7.25 12 7.25C11.5858 7.25 11.25 7.58579 11.25 8V11.25H8C7.58579 11.25 7.25 11.5858 7.25 12C7.25 12.4142 7.58579 12.75 8 12.75H11.25V16C11.25 16.4142 11.5858 16.75 12 16.75C12.4142 16.75 12.75 16.4142 12.75 16V12.75H16C16.4142 12.75 16.75 12.4142 16.75 12C16.75 11.5858 16.4142 11.25 16 11.25H12.75V8Z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <form method="post" action="{{ route('store.cart') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $food->id }}">
                <input type="hidden" name="amount" id="amount-form" value="{{ $count }}">
                <button type="submit"
                    class="w-full text-xl font-bold focus:outline-none text-white bg-yellow-300 hover:bg-yellow-500 rounded-3xl px-5 py-2.5 me-2">
                    Add to Cart - {{ Number::currency($price, 'IDR', 'id') }}
                </button>
            </form>
        </div>
    </div>
</section>
