<?php

namespace App\Livewire;

use Livewire\Component;
use App\Jobs\ExportJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Process;

class Export extends Component
{
    public $batchId;
    public $exporting = false;
    public $exportFinished = false; 

    public function export()
    {
        $this->exporting = true;
        $this->exportFinished = false; 

        $batch = Bus::batch([
            new ExportJob(),
        ])->dispatch();

        $this->batchId = $batch->id;    
    }

    public function getExportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function downloadExport()
    {
        //return Storage::download('public/billings.csv');

        //(new UsersExport)->store('users.xlsx');
    }

    public function updateExportProgress() 
    {
        $this->exportFinished = $this->exportBatch->finished();

        if ($this->exportFinished) {
            $this->exporting = false;  
        }  
         
    }

    public function render()
    {
        return view('livewire.export');
    }
}