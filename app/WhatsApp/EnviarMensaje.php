<?php

namespace App\WhatsApp;
use Illuminate\Support\Facades\Http;
class EnviarMensaje
{
    protected $token;
    protected $url;
    public function __construct() {
        $this->token = env('WPP_TOKEN');
        $this->url = env('WPP_URL');
    }
    public function EnviarMensaje($cuerpo, $numero){
        $data = array(
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $numero,
            "type" => "template",
            "template" => array(
                "name" => "notificar_",
                "language" => array(
                    "code" => "es_AR"
                ),
                "components" => array(
                    array(
                        "type" => "body",
                        "parameters" => array(
                            array(
                                "type" => "text",
                                "cuerpo" => $cuerpo
                            )
                        )
                    )
                )
            )
        );

        $data_string = json_encode($data);

        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->token,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );

        $result = curl_exec($curl);
        curl_close($curl); 
        return response()->json([
            'success' => true,
            'data' => $result,
        ], 200);
    }
    public function FunctionVieja(){
        $cuerpo = "hola mundo";
        try{
            $payload = [
                'messaging_product' => 'whatsapp',
                'to' => '543875318295',
                'type' => 'template',
                "template" => [
                    "name" => "notificar_",
                    "language" => [
                        "code" => "es_AR"
                    ],
                    "components" => array (
                        array(
                            "type" => "body",
                            "parameters" => array(
                                "type" => "text",
                                "cuerpo" => json_encode($cuerpo),
                            )
                        )
                    )
                ]
            ];
            $message = Http::withToken($this->token)->post($this->url, $payload)->throw()->json();
            return response()->json([
                'success' => true,
                'data' => $message,
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
