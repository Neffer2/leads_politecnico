<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Lead;

class MainController extends Controller
{
    public function index()
    {
        $tipos_documento = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-document-type&populate[0]=app_document_type')->json();
        $contacto_preferido = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-contact-method')->json();

        return view('index', compact('tipos_documento', 'contacto_preferido'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobilephone' => 'required|string|max:20',
            'sede' => 'required|string',
            'ilu_cityofresidencecolombia' => 'required|string',
            'tipo_de_documento' => 'required|string',
            'ilu_numerodocumento' => 'required|string|max:20',
            'preferred_contact_method' => 'required|string',
        ]);


        // Obtener catálogos dinámicos
        $sedes = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-campus')->json();
        $programas = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-program')->json();
        $modalidades = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-modality')->json();
        $tipos_programa = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-program-type')->json();
        $tipos_documento = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-document-type')->json();
        $departamentos = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-state')->json();
        $ciudades = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-city')->json();

        $getLabel = function($arr, $code, $default = '') {
            if (!is_array($arr)) return $default;
            foreach ($arr as $item) {
                if ((string)$item['code'] === (string)$code) return $item['label'];
            }
            return $default;
        };

        $leadData = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'mobilephone' => $request->mobilephone,
            'ilu_depcolombia' => $getLabel($departamentos, $request->ilu_depcolombia, $request->ilu_depcolombia),
            'ilu_cityofresidencecolombia' => $getLabel($ciudades, $request->ilu_cityofresidencecolombia, $request->ilu_cityofresidencecolombia),
            'ilu_opportunitytype' => $getLabel($tipos_programa, $request->ilu_opportunitytype, $request->ilu_opportunitytype),
            'modality' => $getLabel($modalidades, $request->modality, $request->modality),
            'program' => $getLabel($programas, $request->program, $request->program),
            'sede' => $getLabel($sedes, $request->sede, $request->sede),
            'tipo_de_documento' => $getLabel($tipos_documento, $request->tipo_de_documento, $request->tipo_de_documento),
            'ilu_numerodocumento' => $request->ilu_numerodocumento,
            'preferred_contact_method' => $request->preferred_contact_method,
        ];

        Lead::create($leadData);

        // Obtener catálogos dinámicos
        $sedes = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-campus')->json();
        $programas = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-program')->json();
        $modalidades = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-modality')->json();
        $tipos_programa = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-program-type')->json();
        $tipos_documento = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-document-type')->json();
        $ciudades = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-city')->json();

        $getLabel = function($arr, $code, $default = '') {
            if (!is_array($arr)) return $default;
            foreach ($arr as $item) {
                if ((string)$item['code'] === (string)$code) return $item['label'];
            }
            return $default;
        };
        $getCode = function($arr, $code, $default = '') {
            if (!is_array($arr)) return $default;
            foreach ($arr as $item) {
                if ((string)$item['code'] === (string)$code) return $item['code'];
            }
            return $default;
        };

        $codeMap = [
            "ESPEC-POS" => "POS",
            "MAEST-POS" => "POS",
            "PROF-PRE" => "PRE",
            "TECNI-PRO" => "PRE",
            "TECNO-PRE" => "PRE"
        ];
        $selectedCode = $getCode($tipos_programa, $request->ilu_opportunitytype, $request->ilu_opportunitytype);

        $leadPayload = [
            "so" => "Windows",
            "app" => "BTL-CAMPAING",
            "owner" => [
                "nameOwner" => "N/A",
                "siteCodeOwner" => "N/A",
                "emailCandidate" => $request->email,
                "documentNumberOwner" => "N/A",
                "documentNumberCandidate" => $request->ilu_numerodocumento
            ],
            "source" => "BTL-CAMPAING",
            "browser" => $request->server('HTTP_USER_AGENT', 'Chrome'),
            "dataCMS" => [
                "so" => $request->server('HTTP_SEC_CH_UA_PLATFORM', 'Android'),
                "app" => "BTL-CAMPAING",
                "owner" => [
                    "userName" => "N/A",
                    "userEmail" => "N/A",
                    "userDocumentNumber" => "N/A"
                ],
                "email" => $request->email ?: "N/A",
                "campus" => [
                    "code" => $getCode($sedes, $request->sede, "MDE"),
                    "label" => $getLabel($sedes, $request->sede, "MEDELLÍN")
                ],
                "source" => "BTL-CAMPAING",
                "browser" => $request->server('HTTP_USER_AGENT', 'Chrome'),
                "program" => [
                    "code" => $getCode($programas, $request->program, "PGCOPME4COP"),
                    "label" => $getLabel($programas, $request->program, "CONTADURÍA PÚBLICA")
                ],
                "lastname" => $request->lastname,
                "modality" => [
                    "code" => $getCode($modalidades, $request->modality, "PRE"),
                    "label" => $getLabel($modalidades, $request->modality, "PRESENCIAL")
                ],
                "timeZone" => "",
                "utm_term" => "organico",
                "appFormId" => "btl-campaing-001",
                "firstname" => $request->firstname,
                "appVersion" => "btl-campaing v1.0",
                "habeasData" => true,
                "personType" => "1",
                "urlReferer" => $request->server('HTTP_REFERER', 'https://poli.edu.co'),
                "utm_medium" => "organico",
                "utm_source" => "organico",
                "acceptTerms" => true,
                "mobilephone" => "+57" . $request->mobilephone,
                "programType" => [
                    "code" => $getCode($tipos_programa, $request->ilu_opportunitytype, "PROF-PRE"),
                    "label" => $getLabel($tipos_programa, $request->ilu_opportunitytype, "PROFESIONAL")
                ],
                "utm_content" => "organico",
                "dataTypeCode" => "LEAD",
                "documentType" => [
                    "code" => $getCode($tipos_documento, $request->tipo_de_documento, "CC"),
                    "label" => $getLabel($tipos_documento, $request->tipo_de_documento, "CÉDULA DE CIUDADANÍA")
                ],
                "utm_campaign" => "organico",
                "contactOrigin" => "OL-5580",
                "contactChannel" => "2",
                "documentNumber" => $request->ilu_numerodocumento,
                "doNotDisturBlaw" => "Si",
                "opportunityType" => [
                    "code" => $codeMap[$selectedCode] ?? "PRE",
                    "label" => $getLabel($tipos_programa, $request->ilu_opportunitytype, "PREGRADO")
                ],
                "requiresApproval" => "Si"
            ],
            "dataCRM" => [
                "contact" => [
                    "email" => $request->email,
                    "lastname" => $request->lastname,
                    "utm_term" => "organico",
                    "firstname" => $request->firstname,
                    "utm_medium" => "organico",
                    "utm_source" => "organico",
                    "mobilephone" => "+57" . $request->mobilephone,
                    "utm_content" => "organico",
                    "tipo_persona" => "1",
                    "utm_campaign" => "organico",
                    "es_bachiller_" => "Si",
                    "ilu_habeasdata" => true,
                    "ilu_originlead" => "OL-5580",
                    "tipo_de_documento" => $getCode($tipos_documento, $request->tipo_de_documento, "CC"),
                    "ilu_donotdisturblaw" => "Si",
                    "ilu_numerodocumento" => $request->ilu_numerodocumento,
                    "ilu_canal_de_captacion" => "2",
                    "preferredcontactmethodcode" => "4",
                    "ilu_cityofresidencecolombia" => $request->ilu_cityofresidencecolombia,
                    "aceptacion_de_terminos_y_condiciones" => true
                ],
                "program" => [
                    "productnumber" => $getCode($programas, $request->program, "PGCOPME4COP")
                ],
                "bussiness" => [
                    "dealstage" => "183090528",
                    "ilu_opportunitytype" => $codeMap[$selectedCode] ?? "PRE",
                    "ilu_origen_automatico" => "OL-5580"
                ],
                "bussinessDetail" => [
                    "statecode" => "0",
                    "ilu_campus" => $getCode($sedes, $request->sede, "MDE"),
                    "statuscode" => "0",
                    "ilu_program" => $getCode($programas, $request->program, "PGCOPME4COP"),
                    "ilu_utmterm" => "organico",
                    "modalidad" => $getCode($modalidades, $request->modality, "PRE"),
                    "ilu_utmmedium" => "organico",
                    "ilu_utmsource" => "organico",
                    "ilu_utmcontent" => "organico",
                    "ilu_programtype" => $getCode($tipos_programa, $request->ilu_opportunitytype, "PROF-PRE"),
                    "ilu_utmcampaing" => "organico",
                    "ilu_id_formulario" => "btl-campaing-001",
                    "ilu_origen_automatico" => "OL-5580"
                ]
            ],
            "urlReferer" => $request->server('HTTP_REFERER', 'https://poli.edu.co'),
            "dataTypeCode" => "LEAD"
        ];

        $response = Http::post('https://app-poli-back.ilumno.com/api/app-cms/lead', $leadPayload);
        $res = $response->json();

        if (isset($res['success']) && $res['success']) {
            return redirect('/')->with('success', 'Lead enviado correctamente.');
        }
    }
}