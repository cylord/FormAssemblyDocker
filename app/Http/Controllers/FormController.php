<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PdfResponse;
use Dompdf\Dompdf;
use Dompdf\Options;
class FormController extends Controller
{
    public function __construct() {
        $this->token = 'JQWd9BYTBGVjNW8xXCs3gR4sJVI0Z5L0';
    }
    public function index() {

        // $query = [['id' => 1, 'firstName'=>'Lance', 'lastName' => 'Barron'],['id' => 2, 'firstName' => 'Chad', 'lastName' => 'Barron']];
        // return response()->json($query, 200);
        
        // $TOKEN_REQUEST_DATA=array(
        //     \"grant_type"=>"authorization_code",
        //  "type"=>"web_server",
        //  "client_id"=>'U0SQO6NXhnQQIbdENjza',
        //  "client_secret"=>'xCQhmQ3vex4lznU9Ozss',
        //  "redirect_uri"=>'http://127.0.0.1:8000/',
        //  "code"=>'emBg3EZ4J7gqqE7HGsBaj3KE8KcA445w'
        // );
        
        $FULL_API_REQUEST = "https://app.formassembly.com/api_v1/forms/index.json?access_token=".$this->token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $FULL_API_REQUEST);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
       

        return $output;
    }

    public function getForm($formID) {

        $FULL_API_REQUEST = 'https://app.formassembly.com/api_v1/forms/view/'.$formID.'.html'.$this->token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $FULL_API_REQUEST);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $formData = curl_exec($ch);
        return $formData;
    }

    public function getResponse($formID) {
        $FULL_API_REQUEST = 'https://app.formassembly.com/api_v1/responses/export/'.$formID.'.html?access_token='.$this->token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $FULL_API_REQUEST);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        
        $options = new Options();
        $options->set('defaultMediaType', 'print');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($output);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->output();
        
        return $dompdf->stream($formID.'.pdf');
    }

    public function sendEmail($formID) {
        
        $response = $formID;
        $emailAddress = 'inet411it@gmail.com';
        Mail::to($emailAddress)->send(
            new PdfResponse($response)
        );
        return back()->with('success','Email sent successfully!');
    }
}
