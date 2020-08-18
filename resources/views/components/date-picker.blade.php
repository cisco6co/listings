<input
    x-data
    x-ref="input"
    x-init="new Pikaday({ field: $refs.input })"
    type="text"
    {{ $attributes }}
    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3"
    readonly="readonly"
>
