<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\exFPDF;
use App\Models\Business;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PosterController extends Controller
{
    public function index(Business $business)
    {
//        abort_if(Gate::denies('poster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pdf=new exFPDF('L','mm',array(95,200));
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetFillColor(12,29,54);
        $pdf->Rect(0,0,$pdf->GetPageWidth(),20,'F');

        $pdf->AddFont('bahaus','','bauhausregular.php');
        $pdf->AddFont('coves','','Coves-Bold.php');
        $pdf->AddFont('covesl','','Coves-Light.php');
        $pdf->AddFont('aquatico','','Aquatico-Regular.php');
        $pdf->AddFont('moonb','','Moon-Bold.php');
        $pdf->AddFont('moonl','','Moon-Light.php');

        $pdf->Output('D','test.pdf');


        return view('admin.posters.index');
    }
}
