<div>
    <a wire:click="export" class="btn btn-outline-primary">Export</a>
 
    @if($exporting && !$exportFinished)   
      {{-- You can change the polling time/cal back of updateExportProgress from 16s--}}
        <div class="d-inline" wire:poll.16s="updateExportProgress">Exporting as Excel file...</div>
    @endif

    @if($exportFinished)
        Done. Download file <a class="stretched-link" wire:click="downloadExport">here</a>
    @endif
</div>