@php
   $date = now();
   $cache_put = \Illuminate\Support\Facades\Cache::put('cache_test', $date, 10);
   $cache_retrieve = \Illuminate\Support\Facades\Cache::get('cache_test');
   $cache_test = $cache_retrieve === NULL ? true : false;

   try{
        $db = DB::connection()->getDatabaseName();
   }catch(Exception $e){
   	$db = $e->getMessage();
   }
@endphp

<p><strong>Cache Test:</strong> {{ $cache_test }}</p>
<p><strong>Database Connection:</strong> {{ $db }}</p>
