@php
   $date = now();
   try {
	$cache_put = \Illuminate\Support\Facades\Cache::put('cache_test', $date, 10);
        $cache_retrieve = \Illuminate\Support\Facades\Cache::get('cache_test');
	$cache_error = NULL;
   } catch(Exception $e){
        $cache_error = $e->getMessage();
   }

   $cache_test = $cache_retrieve !== NULL ? "works" : $cache_error;

   try{
        $db = DB::connection()->getDatabaseName();
	$db_test = true;
   }catch(Exception $e){
   	$db = $e->getMessage();
	$db_test = false;
   }
   $db_test_verbose = $db_test === true ? "works" : $db;
   $laravel_version = Illuminate\Foundation\Application::VERSION;
   $php_version = PHP_VERSION;
@endphp

<p><strong>Cache Test:</strong> {{ $cache_test }}</p>
<p><strong>Database Connection:</strong> {{ $db_test_verbose }}</p>
<p><strong>PHP version:</strong> {{ $php_version }}</p>
<p><strong>Laravel version:</strong> {{ $laravel_version }}</p>
