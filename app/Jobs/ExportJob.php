<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use App\Exports\BillingsExport;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Process\Exceptions\ProcessFailedException;

class ExportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    { 
        \Log::info('befor  csv:');
        #Adding Excel file export to queue...

        (new BillingsExport)->store('public/billings.csv');
        (new BillingsExport)->store('public/billings.xlsx');
        
        \Log::info('befor  started:');
        
        //$result = Process::run('ls -la');
        try {
            $process = Process::start(Artisan::call('queue:work', 
            [
            '--stop-when-empty' => 1,
                '--queue' => 'default'
            ]
            ));
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

        } catch (\Exception $th) {
            //throw $th;
            throw($th);
            session('error', 'File cannot be downloaded: ' 
            . $th->getMesage());
                            
        }
        \Log::info('queuein bckground :   started:');
        return true;
    }  
}













