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
            'ciudad' => 'required|string',
            'tipo_de_documento' => 'required|string',
            'ilu_numerodocumento' => 'required|string|max:20',
            'Tprograma' => 'required|string',
            'programa' => 'required|string',
            'modalidad' => 'required|string',
            'ilu_habeasdata' => 'required|boolean',
            'aceptacion_de_terminos_y_condiciones' => 'required|boolean',
        ]);

        Lead::create($request->all());

        // Mapeo de códigos y labels
        $tipos_programa = [
            'ESPEC-POS' => ['code' => 'POS', 'label' => 'ESPECIALIZACIÓN'],
            'MAEST-POS' => ['code' => 'POS', 'label' => 'MAESTRÍA'],
            'PROF-PRE' => ['code' => 'PRE', 'label' => 'PROFESIONAL'],
            'TECNI-PRO' => ['code' => 'PRE', 'label' => 'TÉCNICO'],
            'TECNO-PRE' => ['code' => 'PRE', 'label' => 'TECNÓLOGO'],
        ];
        $selectedTipoPrograma = $request->Tprograma;
        $programType = $tipos_programa[$selectedTipoPrograma] ?? ['code' => 'PRE', 'label' => 'PREGRADO'];

        $payload = [
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
            "browser" => $request->header('User-Agent'),
            "dataCMS" => [
                "so" => PHP_OS,
                "app" => "BTL-CAMPAING",
                "owner" => [
                    "userName" => "N/A",
                    "userEmail" => "N/A",
                    "userDocumentNumber" => "N/A"
                ],
                "email" => $request->email,
                "campus" => [
                    "code" => $request->ciudad ?? "MDE",
                    "label" => $request->ciudad_label ?? "MEDELLÍN"
                ],
                "source" => "BTL-CAMPAING",
                "browser" => $request->header('User-Agent'),
                "program" => [
                    "code" => $request->programa ?? "PGCOPME4COP",
                    "label" => $request->programa_label ?? "CONTADURÍA PÚBLICA"
                ],
                "lastname" => $request->lastname,
                "modality" => [
                    "code" => $request->modalidad ?? "PRE",
                    "label" => $request->modalidad_label ?? "PRESENCIAL"
                ],
                "timeZone" => "",
                "utm_term" => "organico",
                "appFormId" => "btl-campaing-001",
                "firstname" => $request->firstname,
                "appVersion" => "btl-campaing v1.0",
                "habeasData" => $request->ilu_habeasdata,
                "personType" => "1",
                "urlReferer" => $request->headers->get('referer') ?? "https://poli.edu.co",
                "utm_medium" => "organico",
                "utm_source" => "organico",
                "acceptTerms" => $request->aceptacion_de_terminos_y_condiciones,
                "mobilephone" => $request->mobilephone,
                "programType" => [
                    "code" => $programType['code'],
                    "label" => $programType['label']
                ],
                "utm_content" => "organico",
                "dataTypeCode" => "LEAD",
                "documentType" => [
                    "code" => $request->tipo_de_documento ?? "CC",
                    "label" => $request->tipo_de_documento_label ?? "CÉDULA DE CIUDADANÍA"
                ],
                "utm_campaign" => "organico",
                "contactOrigin" => "OL-5580",
                "contactChannel" => "2",
                "documentNumber" => $request->ilu_numerodocumento,
                "doNotDisturBlaw" => "Si",
                "opportunityType" => [
                    "code" => $programType['code'],
                    "label" => $programType['label']
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
                    "mobilephone" => $request->mobilephone,
                    "utm_content" => "organico",
                    "tipo_persona" => "1",
                    "utm_campaign" => "organico",
                    "es_bachiller_" => "Si",
                    "ilu_habeasdata" => $request->ilu_habeasdata,
                    "ilu_originlead" => "OL-5580",
                    "tipo_de_documento" => $request->tipo_de_documento ?? "CC",
                    "ilu_donotdisturblaw" => "Si",
                    "ilu_numerodocumento" => $request->ilu_numerodocumento,
                    "ilu_canal_de_captacion" => "2",
                    "preferredcontactmethodcode" => "4",
                    "ilu_cityofresidencecolombia" => $request->ciudad ?? "CO91001",
                    "aceptacion_de_terminos_y_condiciones" => $request->aceptacion_de_terminos_y_condiciones
                ],
                "program" => [
                    "productnumber" => $request->programa ?? "PGCOPME4COP"
                ],
                "bussiness" => [
                    "dealstage" => "183090528",
                    "ilu_opportunitytype" => $programType['code'],
                    "ilu_origen_automatico" => "OL-5580"
                ],
                "bussinessDetail" => [
                    "statecode" => "0",
                    "ilu_campus" => $request->ciudad ?? "MDE",
                    "statuscode" => "0",
                    "ilu_program" => $request->programa ?? "PGCOPME4COP",
                    "ilu_utmterm" => "organico",
                    "modalidad" => $request->modalidad ?? "PRE",
                    "ilu_utmmedium" => "organico",
                    "ilu_utmsource" => "organico",
                    "ilu_utmcontent" => "organico",
                    "ilu_programtype" => $programType['code'],
                    "ilu_utmcampaing" => "organico",
                    "ilu_id_formulario" => "btl-campaing-001",
                    "ilu_origen_automatico" => "OL-5580"
                ]
            ],
            "urlReferer" => "https://poli.edu.co",
            "dataTypeCode" => "LEAD"
        ];

        $response = Http::post('https://app-poli-back.ilumno.com/api/app-cms/lead', $payload);
        $res = $response->json();

        if (isset($res['success']) && $res['success']) {
            return redirect('/')->with('success', 'Lead enviado correctamente.');
        }
    }
}
