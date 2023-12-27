<?php

namespace App\Http\Controllers; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\UsersExport;

class UserController extends Controller
{  
    /* 
    data export using  Maatwebsite
    */
    // public function export() 
    // {
        
    //     //$re = Excel::download(new UsersExport, 'users.xlsx');

    //     // Store on default disk
    //     Excel::store(new UsersExport(2018), 'users.xlsx', 's3');


    // Excel::store(new InvoicesExport(2018), 'users.xlsx');
    //     if($re)
    //     echo "yes";
    // else
    // echo "no";
    //      exit;

    //     $re = (new UsersExport)->store('users.xlsx');
    //     print_r("stored-$re");
    //  exit;
    //   $res = (new UsersExport)->queue('users.xlsx');
    
      
    // echo  back()->withSuccess('Export started!');
    // // print_r($res);
    //  echo 11;exit;
    //     // (new UsersExport)->queue('users.xlsx')->chain([
    //     //     new NotifyUserOfCompletedExport(request()->user()),
    //     // ]);
        
        
    //     //return Excel::download(new UsersExport, 'users.xlsx');
    //     //\Log::info('$i++');
       
    //     //return Excel::download(new UsersExport, 'users.xlsx');
    // }
    /**
     * Users view
     */
     
    public function view() 
    {
        return view('users');
    }
    /**
     * Do the export of given user table to excel.
     */
    public function exportD() {
        $users = User::all()->toArray(); 
        //set headers to download csv
        $this->download_send_headers("users_" . date("Y-m-d") . ".csv");
        //write content to csv
        $is_downloaded =  $this->array2csv($users);
        if ($is_downloaded) {
            # code...
            echo "file downloaded";
        } else {
            echo "file not downloaded";
        }
        die();
        exit;
        
    } 
    /* Function for downloading
       $filename - Excel file name for download 
    */
    public function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");
        
        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        
        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }
    /* 
    Function to convert array to csv file
    
    */
    public function array2csv($array)
    {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }
}