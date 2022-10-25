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

   if($cache_retrieve) {
	$dispatch_job = \App\Jobs\TestJob::dispatch();
        $now_max = now()->subSeconds(30)->timestamp;
        $job_test = \Illuminate\Support\Facades\Cache::get('job_test');
        if($job_test) {
           if($job_test < $now_max) {
               \App\Jobs\TestJob::dispatch();
               $job_test = \Illuminate\Support\Facades\Cache::get('job_test');
           }
        } else {
	   \App\Jobs\TestJob::dispatch();
           $job_test = \Illuminate\Support\Facades\Cache::get('job_test');
	}
   }
   try {
	$ip = \Illuminate\Support\Facades\Http::get('https://api.ipify.org');
   } catch(Exception $e) {
	$ip = "failed http request:".$e->getMessage();
   }

@endphp


<p><strong>App URL:</strong> {{ env('APP_URL') }}</p>
<p><strong>App Environment:</strong> {{ env('APP_ENV') }}</p>
<p><strong>Curl PHP Test:</strong> {{ $ip }} (https://api.ipify.org)</strong></p>
<p><strong>Cache Test:</strong> {{ $cache_test }}</p>
<p><strong>Database Connection:</strong> {{ $db_test_verbose }}</p>
<p><strong>PHP version:</strong> {{ $php_version }}</p>
<p><strong>Laravel version:</strong> {{ $laravel_version }}</p>
<p><strong>Job Test:</strong> {{ $job_test }}</p>
