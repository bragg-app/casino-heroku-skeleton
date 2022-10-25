@php
   $date = now();
   try {
	$cache_put = \Illuminate\Support\Facades\Cache::put('cache_test', $date, 10);
        $cache_retrieve = \Illuminate\Support\Facades\Cache::get('cache_test');
	$cache_error = NULL;
   } catch(Exception $e){
	$cache_retrieve = NULL;
        $cache_error = $e->getMessage();
   }

   $cache_test = $cache_retrieve === NULL ? true : false;
   $cache_test_verbose = $cache_test === true ? "works" : $cache_error;

   try{
        $db = DB::connection()->getDatabaseName();
	$db_test = true;
   }catch(Exception $e){
   	$db = $e->getMessage();
	$db_test = false;
   }
   $db_test_verbose = $db_test === true ? "works" : $db;
@endphp

<p><strong>Cache Test:</strong> {{ $cache_test_verbose }}</p>
<p><strong>Database Connection:</strong> {{ $db_test_verbose }}</p>
