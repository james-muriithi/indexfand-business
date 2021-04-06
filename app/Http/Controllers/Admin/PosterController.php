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

        $pdf=new exFPDF('L','mm',array(92,150));
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
        $pdf->setXY($pdf->GetPageWidth() / 1.2, 5);
        $pdf->setTextColor(255, 255, 255);
        $pdf->Cell(19,12,"Lipa  Chap  Chap!",0,0,"R");

        //body
        $url = "https://indexfand.com/pay/".$business->tag;

        $y = $pdf->GetY()+25;
        $pdf->setTextColor(33, 33, 33);
        $pdf->SetXY(7, $y);
        $pdf->SetFont('moonb','',19);
        $pdf->Cell(29,7,'PAYBILL:',0,"L");
        $pdf->SetFont('coves','',19);
        $pdf->setXY(38,$y - 2);
        $pdf->Cell(29,12, '4030551',0,"L");

        $y = $pdf->GetY()+ 15;
        $pdf->setTextColor(33, 33, 33);
        $pdf->SetXY(7, $y);
        $pdf->SetFont('moonb','',19);
        $pdf->Cell(29,7,'ACCOUNT:',0,"L");
        $pdf->SetFont('coves','',19);
        $pdf->setXY(43,$y - 3);
        $pdf->Cell(29,12, strtolower($business->tag),0,"L");

        $y = $pdf->GetY()+ 15;
        $pdf->setTextColor(84, 59, 121);
        $pdf->SetXY(5, $pdf->GetY()+ 20);
        $pdf->SetFont('coves','',15);
        $pdf->Cell(29,7,$url,0,"L");


        //qr
        $qr = QRCode::text($url)
            ->setOutfile('images/qrs/'.$business->tag.'.png')
            ->setSize(4)
            ->png();

        $pdf->image( 'images/qrs/'.$business->tag.'.png',$pdf->GetPageWidth()-50,21,-76);
        //scan to pay
        $pdf->SetFont('coves','',16);
        $pdf->setXY($pdf->GetPageWidth()-27, $pdf->GetPageHeight() - 29);
        $pdf->setTextColor(64, 64, 64);
        $pdf->Cell(19,12,"Scan to pay",0,0,"R");

        //footer
        $pdf->setDrawColor(166, 166, 166);
        $pdf->line(0,$pdf->GetPageHeight() - 15,$pdf->GetPageWidth() - 42,$pdf->GetPageHeight() - 15);
//        $pdf->SetFillColor(0, 153, 0);
//        $pdf->Rect(0, $pdf->GetPageHeight() - 15, $pdf->GetPageWidth(),15,'F');
        $pdf->setTextColor(31, 31, 31);
        $pdf->SetFont('moonb','',17);
        $pdf->SetXY(10,$pdf->GetPageHeight() - 16);
        $pdf->Cell(19,13, ucwords($business->name),0,0, 'L');

        //footer image
        $pdf->image( 'images/logos/logo-footer.png',$pdf->GetPageWidth()-42,$pdf->GetPageHeight() - 19,40);

        $pdf->setDrawColor(12,29,54);
        $pdf->SetLineWidth(2);
        $pdf->line(0,$pdf->GetPageHeight() - 5,$pdf->GetPageWidth(),$pdf->GetPageHeight() - 5);

        $pdf->setDrawColor(255, 255, 255);
        $pdf->SetLineWidth(0.4);
        $pdf->line(5,$pdf->GetPageHeight() - 3,$pdf->GetPageWidth() - 46,$pdf->GetPageHeight() - 3);

        $pdf->SetLineWidth(2);
        $pdf->setDrawColor(12,29,54);
        $pdf->line(0,$pdf->GetPageHeight() - 3,$pdf->GetPageWidth() - 40,$pdf->GetPageHeight() - 2.5);

        $pdf->setDrawColor(255, 204, 0);
        $pdf->SetLineWidth(2);
        $pdf->line($pdf->GetPageWidth() - 37.7,$pdf->GetPageHeight() - 3,$pdf->GetPageWidth(),$pdf->GetPageHeight() - 3);

        $pdf->Output('D','test.pdf');


        return view('admin.posters.index');
    }
}
