@props(['title', 'value', 'chartId', 'icon' => 'ri-bar-chart-line'])

<div class="col-span-full md:col-span-6 2xl:col-span-3 relative p-4 dk-border-one rounded-xl h-full dk-theme-card-square bg-white dark:bg-dark overflow-hidden">
    <i class="{{ $icon }} absolute top-4 right-4 text-[56px] text-primary-500/10 dark:text-primary-300/10 z-0" style="font-size: 26px;"></i>

    <div class="relative z-10">
        <h6 class="leading-none text-gray-500 dark:text-dark-text font-semibold mb-4">{{ $title }}</h6>

        <div class="flex justify-between items-center">
            <div class="shrink-0">
                <div class="text-[32px] font-bold text-gray-900 dark:text-white leading-tight">
                    {{ $value }}
                </div>
            </div>
            <div class="max-w-[100px]">
                <div id="{{ $chartId }}"></div>
            </div>
        </div>
    </div>
</div>
