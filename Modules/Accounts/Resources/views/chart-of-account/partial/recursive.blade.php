<!-- Recursive blade to print chart-of-accounts -->
@if(!$childHead->childHeads->count())
    <!-- Print Head - 1 -->
    <tr>
        @for($i=1;$i<=6;$i++)
            @if($childHead->head_level==$i)
                <td>{{$childHead->code}}</td>
            @else
                <td></td>
            @endif
        @endfor
        <td>{{$childHead->bangla_name}}</td>
        <td>{{$childHead->english_name}}</td>
        <td>{{$childHead->description}}</td>
    </tr>

    @if($childHead->head_level == 5)
        @foreach($childHead->economyCodes as $economyCode)
            <!-- print Code -->
            <tr>
                @for($i=1;$i<=6;$i++)
                    @if($i == 6)
                        <td>{{$economyCode->code}}</td>
                    @else
                        <td></td>
                    @endif
                @endfor
                <td>{{$economyCode->bangla_name}}</td>
                <td>{{$economyCode->english_name}}</td>
                <td>{{$economyCode->description}}</td>
            </tr>
        @endforeach
    @endif
@else
    <!-- print the row -->
    <tr>
        @for($i=1;$i<=6;$i++)
            @if($childHead->head_level==$i)
                <td>{{$childHead->code}}</td>
            @else
                <td></td>
            @endif
        @endfor
        <td>{{$childHead->bangla_name}}</td>
        <td>{{$childHead->english_name}}</td>
        <td>{{$childHead->description}}</td>
    </tr>
    @foreach($childHead->childHeads as $childHead)
        <!-- include again passing the code -->
        @include('accounts::chart-of-account.partial.recursive',$childHead)
    @endforeach
@endif

