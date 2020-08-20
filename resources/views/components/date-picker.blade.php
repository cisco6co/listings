<input
    x-data
    x-ref="input"
    x-init="
    new Pikaday({
        field: $refs.input,
        onSelect: function(date) {
            $dispatch('input', this.getMoment().format('YYYY-MM-DD'));
        }
    })
    "
    type="text"
    wire:ignore
    {{ $attributes }}
    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3"
    readonly="readonly"
>
