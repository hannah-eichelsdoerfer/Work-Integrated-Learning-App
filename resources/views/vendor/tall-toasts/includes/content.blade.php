<div
    class="overflow-hidden z-50 p-3 rounded-md shadow cursor-pointer pointer-events-auto select-none ltr:border-l-8 rtl:border-r-8 dark:bg-black"
    x-bind:class="[
        toast.type === 'info' ? 'border-blue-700' : '',
        toast.type === 'success' ? 'border-green-700' : '',
        toast.type === 'warning' ? 'border-yellow-700' : '',
        toast.type === 'danger' ? 'border-red-700' : '',
        toast.type === 'info' ? 'bg-blue-100' : '',
        toast.type === 'success' ? 'bg-green-100' : '',
        toast.type === 'warning' ? 'bg-yellow-100' : '',
        toast.type === 'danger' ? 'bg-red-100' : ''
    ]"
>
    <div class="flex justify-between items-center space-x-5 rtl:space-x-reverse">
        <div class="flex-1 ltr:mr-2 rtl:ml-2">
            <div
                class="mb-1 text-lg font-black tracking-widest text-gray-900 uppercase font-large dark:text-gray-100"
                x-html="toast.title"
                x-show="toast.title !== undefined"
            ></div>

            <div
                class="text-gray-900 dark:text-gray-200"
                x-show="toast.message !== undefined"
                x-html="toast.message"
            ></div>
        </div>

        @include('tall-toasts::includes.icon')
    </div>
</div>
