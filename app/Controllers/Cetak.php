<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Cetak extends BaseController
{
  public function index()
  {
      return view('drh');
  }

  function drh(){
      $dompdf = new \Dompdf\Dompdf();
      $dompdf->loadHtml(view('drh'));
      $dompdf->setPaper('A4', 'potrait');
      $dompdf->render();
      $dompdf->stream("", ["Attachment" => false]);
  }
}
