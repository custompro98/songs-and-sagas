@props(['copyText', 'notificationText' => 'Copied!', 'showText', 'class'])

<div class="flex flex-row gap-1 w-full md:justify-center" x-data="{
    copyText: {{ $copyText }},
    copyNotification: false,
    copyToClipboard() {
        $clipboard(this.copyText)
        this.copyNotification = true
        const that = this;
        setTimeout(function() {
            that.copyNotification = false
        }, 1000)
    }
}">
    <div class="relative z-20 w-fit">
        <div x-show="copyNotification" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-2" class="absolute left-0" x-cloak>
            <div
                class="px-3 h-7 -ml-1.5 items-center flex text-xs bg-green-500 border-r border-green-500 -translate-x-full text-white rounded">
                <span>{{ $notificationText }}</span>
                <div
                    class="absolute right-0 inline-block h-full -mt-px overflow-hidden translate-x-3 -translate-y-2 top-1/2">
                    <div class="w-3 h-3 origin-top-left transform rotate-45 bg-green-500 border border-transparent">
                    </div>
                </div>
            </div>
        </div>
        <button x-on:click="copyToClipboard()">
            <x-icon-square-2-stack class="{{ $class }}" />
        </button>
    </div>
    <p class="truncate">{{ $showText }}</p>
</div>
