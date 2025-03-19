<div class="tbk-table">

    <div class="table-column tbk-head">
        Campo
    </div>
    <div class="table-column tbk-head">
        Valor
    </div>

    @foreach ($request as $property => $value)
        @if (is_array($value))
            @foreach ($value as $detail)
                <div class="table-column">
                    {{ $property }}[{{ $loop->index }}]
                </div>
                <div class="table-column flex-col">
                    @foreach ($detail as $propertyKey => $valueKey)
                        <span>{{ $propertyKey }}: {{ $valueKey }}</span>
                    @endforeach
                </div>
            @endforeach
        @else
            <div class="table-column">{{ $property }}</div>
            <div class="table-column">{{ $value }}</div>
        @endif
    @endforeach

</div>

<div class="tbk-table-xs">
    @foreach ($request as $property => $value)
        @if (is_array($value))
            @foreach ($value as $detail)
                <div class="table-row-xs">
                    <p>
                        <span>Campo:</span> {{ $property }}[{{ $loop->index }}]
                    </p>
                    <p class="flex-col">
                        @foreach ($detail as $propertyKey => $valueKey)
                            <span>{{ $propertyKey }}:</span> {{ $valueKey }}
                        @endforeach
                    </p>
                </div>
            @endforeach
        @else
            <div class="table-row-xs">
                <p><span>Campo:</span> {{ $property }}</p>
                <p><span>Valor:</span> {{ $value }}</p>
            </div>
        @endif
    @endforeach
</div>
