@php
    $date = strtotime($value);
@endphp
<div class="badge absolute top post-date badge-outline">
    <div class="badge-inner">
        <span class="post-date-day">{!! date('d',$date) !!}</span><br>
        <span class="post-date-month is-xsmall">{!! date('M',$date) !!}</span>
    </div>
</div>