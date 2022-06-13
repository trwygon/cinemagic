<style>
    .grid-cols-22 {
        grid-template-columns: repeat(22, minmax(0, 1fr))
    }

    .grid-cols-17 {
        grid-template-columns: repeat(17, minmax(0, 1fr))
    }

    .fa-secondary {
        opacity: .4
    }
</style>

<x-dashboard.layout title="Cinemagic - Comprar bilhete" header="Comprar bilhete">
    <x-dashboard.card-container>
        <div class="grid grid-cols-{{ $seats->max('posicao') + 2 }} gap-1">
            @foreach ($seats as $seat)
                @if ($seat->posicao == 1)
                    <span type="submit" class="w-full">
                        <div class="outline text-right pr-2 dark:outline-gray-200 dark:text-gray-200">
                            Fila {{ $seat->fila }}
                        </div>
                    </span>
                @endif
                <form method="POST" action="{{ route('cart.store', [$screening, $seat]) }}">
                    @csrf
                    <button type="submit" class="w-full">
                        <div>
                            {{-- {{ $seat->posicao . ' ' }} --}}
                            <svg class="w-12 h-12
                            {{ $seat->isOccupied($screening->id) ? 'fill-red-400' : '' }}
                            {{ $seat->isInCart($screening->id) ? 'fill-green-400' : '' }}
                            fill-gray-300"
                                viewBox="0 0 512 512">
                                <path
                                    d="M64 226.938V160C64 89.305 121.309 32 192 32H320C390.695 32 448 89.305 448 160V226.938C429.398 233.547 416 251.133 416 272V352H96V272C96 251.133 82.602 233.547 64 226.938Z"
                                    class="fa-secondary" />
                                <path
                                    d="M464 224C437.49 224 416 245.49 416 272V352H96V272C96 245.49 74.51 224 48 224S0 245.49 0 272V464C0 472.836 7.164 480 16 480H80C88.836 480 96 472.836 96 464V448H416V464C416 472.836 423.164 480 432 480H496C504.836 480 512 472.836 512 464V272C512 245.49 490.51 224 464 224Z"
                                    class="fa-primary" />
                            </svg>
                        </div>
                    </button>
                </form>
                @if ($seat->posicao == $seats->max('posicao'))
                    <span type="submit" class="w-full">
                        <div class="outline pl-2 dark:outline-gray-200 dark:text-gray-200">
                            Fila {{ $seat->fila }}
                        </div>
                    </span>
                @endif
            @endforeach
        </div>
        <div class="w-full block dark:text-gray-200">
            <div class="float-left text-sm">
                Capacidade:
                <span class="font-bold">{{ $seats->count() }}</span>
            </div>
            <div class="float-right ">
                Lugares livres:
                <span class="font-bold">
                    {{ $seats->count() - $occupied }}
                </span>
            </div>
        </div>
    </x-dashboard.card-container>
</x-dashboard.layout>
