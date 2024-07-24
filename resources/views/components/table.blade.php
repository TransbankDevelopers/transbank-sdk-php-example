<div class="tbk-table">

    <div class="table-column tbk-head">
        Campo
    </div>
    <div class="table-column tbk-head">
        Valor
    </div>

    @foreach ($request as $property => $value)
        <div class="table-column">{{ $property }}</div>
        <div class="table-column">{{ $value }}</div>
    @endforeach

</div>

<div class="tbk-table-xs">
    @foreach ($request as $property => $value)
        <div class="table-row-xs">
            <p><span>Campo:</span> {{ $property }}</p>
            <p><span>Valor:</span> {{ $value }}</p>
        </div>
    @endforeach
</div>
