@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{Storage::url('logo2.png')}}" class="logo" alt="Logo Peluquería">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
