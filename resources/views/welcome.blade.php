@php
   $date = now();
   $cache_put = \Illuminate\Support\Facades\Cache::put('cache_test', $data, 10);
   $cache_retrieve = \Illuminate\Support\Facades\Cache::get('cache_test');
   $cache_test = $cache_retrieve === NULL ? 'passed' : $cache_retrieve;

@endphp

Cache Test: {{ $cache_test }}

