@props(['ico', 'title', 'amount', 'kpi', 'detail', 'bg'])
<div class="w-fit px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
    <div class="relative flex flex-col min-w-0 break-words shadow-xl bg-slate-850 shadow-dark-xl rounded-2xl bg-clip-border p-2">
        <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                        <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">{{ $title }}</p>
                        <h5 class="mb-2 font-bold text-white decoration-teal-500 underline">{{ $amount }}</h5>
                        <p class="mb-0 dark:text-white dark:opacity-60">
                        @if( $kpi > 0 )
                            <span class="text-sm font-bold leading-normal text-emerald-500">+{{ $kpi }}%</span>                            
                        @else
                            <span class="text-sm font-bold leading-normal text-red-500">{{ $kpi }}%</span>
                        @endif
                        &nbsp;<small>{{ $detail }}</small>
                        </p>
                    </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                    <div class="{{ $bg }} text-white rounded-full w-12 h-12">
                        @svg( $ico, 'w-7 h-7' )
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>