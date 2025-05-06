@props([
    'rows' => [],
])

<div class="tbk-table auto-width">

    <div class="table-column tbk-head">
        <span>Campo</span>
    </div>
    <div class="table-column tbk-head">
        <span>Valor</span>
    </div>

    @foreach ($rows as $row)
        <div class="table-column">
            {{ $row['field'] }}
        </div>
        <div class="table-column flex-col">
            @if (is_array($row['value']))
                @foreach ($row['value'] as $item)
                    <span>{{ $item }}</span>
                @endforeach
            @else
                <span class="tbk-column">{{ $row['value'] }}</span>
            @endif
        </div>
    @endforeach

</div>
