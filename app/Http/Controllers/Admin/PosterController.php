<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\exFPDF;
use App\Models\Business;
use Gate;
use LaravelQRCode\Facades\QRCode;

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

        //logo
        $pdf->image('images/logos/logo.png',10,2,17, 17);

        //name
        $pdf->SetFont('moonb','',35);
        $pdf->setXY($pdf->GetPageWidth() / 1.4, 5);
        $pdf->setTextColor(255, 255, 255);
        $pdf->Cell(19,12,"Lipa  Chap  Chap!",0,0,"R");


        //qr
        $url = "https://indexfand.com/pay/".$business->tag;
        $qr = QRCode::text($url)
            ->setOutfile('images/qrs/'.$business->tag.'.png')
            ->setSize(4)
            ->png();

        $pdf->image( 'images/qrs/'.$business->tag.'.png',$pdf->GetPageWidth()-50,23,-76);
        //scan to pay
        $pdf->SetFont('coves','',18);
        $pdf->setXY($pdf->GetPageWidth()-27, $pdf->GetPageHeight() - 29);
        $pdf->setTextColor(64, 64, 64);
        $pdf->Cell(19,12,"Scan to pay",0,0,"R");

        $pdf->setDrawColor(166, 166, 166);
        $pdf->line(0,$pdf->GetPageHeight() - 15,$pdf->GetPageWidth() - 42,$pdf->GetPageHeight() - 15);
//        $pdf->SetFillColor(0, 153, 0);
//        $pdf->Rect(0, $pdf->GetPageHeight() - 15, $pdf->GetPageWidth(),15,'F');
        $pdf->setTextColor(51, 51, 51);
        $pdf->SetFont('bahaus','',22);
        $pdf->SetXY(10,$pdf->GetPageHeight() - 14);
        $pdf->Cell(19,13, ucwords($business->name),0,0, 'L');

        //footer image
        $pdf->image( 'images/logos/logo-footer.png',$pdf->GetPageWidth()-42,$pdf->GetPageHeight() - 15,40);

        $pdf->Output('D','test.pdf');


        return view('admin.posters.index');
    }
}
