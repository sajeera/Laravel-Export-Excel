<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Process;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/user', function () {
    return view('users');
}); 

Route::get('/queue', function () {

    try {
        $process = Process::start('ls -la');

        while ($process->running()) {
        // echo $process->latestOutput();
        
            if ($process->latestErrorOutput()) {
                # code...
                throw($process->latestErrorOutput());
            }
        
            sleep(1);
        }
        $result = $process->wait();
        
        session('success', 'File is downloaded.!');
        print_r($process);
        echo  $process->id();
    } catch (\Exception $th) {
        //throw $th;
        throw($th);
        session('error', 'File cannot be downloaded: ' 
        . $th->getMesage());
                        
    }
    \Log::info('in bckground :   started:');
     
    $process = Process::start('ls -la', 
    function (string $type, string $output){
        echo $output;
    });
 
    while ($process->running()) {
        echo $process->latestOutput();
        echo $process->latestErrorOutput();
        echo 333;
      //  sleep(1);
    }

    $result = $process->wait();

print_r($result);
   exit;
    //$result = Process::run('ls -la');
    $process = Process::start(Artisan::call('queue:work', 
    [
     //   '--stop-when-empty' => true,
        '--queue' => 'default'
    ]
    ));
   // print_r($process);exit;
    $result = $process->wait();

    // $result->successful();
    // $result->failed();
    // $result->exitCode();
    // $result->output();
    // $result->errorOutput();
    print_r($result);
echo $result->output();
exit;
    $exitCode = Artisan::call('queue:work', [
        'user' => $user, '--queue' => 'default'
    ]);
 
    // ...
});

