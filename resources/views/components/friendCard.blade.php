<div class="overflow-hidden rounded-lg shadow-lg">

    <div class="flex items-center justify-between leading-none p-2 md:p-4">
        <a class="flex items-center no-underline hover:underline text-black" href="/user/{{ $name }}">
            <img alt=" Placeholder" class="block rounded-full" src="{{ $photo }}">

            {{--
            src="https://picsum.photos/32/32/?random"> --}}

            <p class="ml-2 text-sm">
                {{ $name }}
            </p>
        </a>
    </div>
</div>
