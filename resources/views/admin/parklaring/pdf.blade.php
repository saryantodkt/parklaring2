@php
    $parklaringInfo = $parklaring;
@endphp

@if($template->id == 1)
    @include('temp-reguler', ['parklaringInfo' => $parklaringInfo])
@elseif($template->id == 2)
    @include('temp-probation', ['parklaringInfo' => $parklaringInfo])
@elseif($template->id == 3)
    @include('temp-contract', ['parklaringInfo' => $parklaringInfo])
@else
    @include('temp-reissued', ['parklaringInfo' => $parklaringInfo])
@endif
