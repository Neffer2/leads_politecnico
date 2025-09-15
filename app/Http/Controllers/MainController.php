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
            'ilu_cityofresidencecolombia' => 'required|string',
            'tipo_de_documento' => 'required|string',
            'ilu_numerodocumento' => 'required|string|max:20',
            'preferred_contact_method' => 'required|string',
        ]);

        Lead::create($request->all());

        if ($request->ilu_opportunitytype === 'ESPEC-POS') {
            $label = 'ESPECIALIZACIÓN';
        } elseif ($request->ilu_opportunitytype === 'MAEST-POS') {
            $label = 'MAESTRÍA';
        } elseif ($request->ilu_opportunitytype === 'PROF-PRE') {
            $label = 'PROFESIONAL';
        } elseif ($request->ilu_opportunitytype === 'TECNI-PRO') {
            $label = 'TÉCNICO';
        } elseif ($request->ilu_opportunitytype === 'TECNO-PRE') {
            $label = 'TECNÓLOGO';
        }

        $response = Http::post('https://app-poli-back.ilumno.com/api/app-cms/lead', [
            "so" => "Windows",
            "app" => "BTL-CAMPAING",
            "owner" => [
                "nameOwner" => "N/A",
                "siteCodeOwner" => "N/A",
                "emailCandidate" => "testbtl220720251725@ilutest.com",
                "documentNumberOwner" => "N/A",
                "documentNumberCandidate" => "1000000001"
            ],
            "source" => "BTL-CAMPAING",
            "browser" => "Chrome",
            "dataCMS" => [
                "so" => "Android",
                "app" => "BTL-CAMPAING",
                "owner" => [
                    "userName" => "N/A",
                    "userEmail" => "N/A",
                    "userDocumentNumber" => "N/A"
                ],
                "email" => "testbtl220720251725@ilutest.com",
                "campus" => [
                    "code" => "MDE",
                    "label" => "MEDELLÍN"
                ],
                "source" => "BTL-CAMPAING",
                "browser" => "Chrome",
                "program" => [
                    "code" => $request->program,
                    "label" => "CONTADURÍA PÚBLICA"
                ],
                "lastname" => $request->lastname,
                "modality" => [
                    "code" => $request->modality,
                    "label" => ($request->modality === "PRE") ? "PRESENCIAL" : "VIRTUAL"
                ],
                "timeZone" => "",
                "utm_term" => "organico",
                "appFormId" => "btl-campaing-001",
                "firstname" => $request->firstname,
                "appVersion" => "btl-campaing v1.0",
                "habeasData" => true,
                "personType" => "1",
                "urlReferer" => "https://poli.edu.co",
                "utm_medium" => "organico",
                "utm_source" => "organico",
                "acceptTerms" => true,
                "mobilephone" => '+57'.$request->mobilephone,
                "programType" => [
                    "code" => $request->ilu_opportunitytype,
                    "label" => $label
                ],
                "utm_content" => "organico",
                "dataTypeCode" => "LEAD",
                "documentType" => [
                    "code" => "CC",
                    "label" => "CÉDULA DE CIUDADANÍA"
                ],
                "utm_campaign" => "organico",
                "contactOrigin" => "OLPG-00000043",
                "contactChannel" => "2",
                "documentNumber" => "1000000001",
                "doNotDisturBlaw" => "Si",

                "opportunityType" => [
                    "code" => $request->ilu_opportunitytype,
                    "label" => $label
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
                    "mobilephone" => '+57'.$request->mobilephone,
                    "utm_content" => "organico",
                    "tipo_persona" => "1",
                    "utm_campaign" => "organico",
                    "es_bachiller_" => "Si",
                    "ilu_habeasdata" => true,
                    "ilu_originlead" => "OL-5580",
                    "tipo_de_documento" => $request->tipo_de_documento,
                    "ilu_donotdisturblaw" => "Si",
                    "ilu_numerodocumento" => $request->ilu_numerodocumento,
                    "ilu_canal_de_captacion" => "2",
                    "preferredcontactmethodcode" => "4",
                    "ilu_cityofresidencecolombia" => $request->ilu_cityofresidencecolombia,
                    "aceptacion_de_terminos_y_condiciones" => true
                ],
                "program" => [
                    "productnumber" => $request->program
                ],
                "bussiness" => [
                    "dealstage" => "183090528",
                    "ilu_opportunitytype" => $request->ilu_opportunitytype,
                    "ilu_origen_automatico" => " OL-5580"
                ],
                "bussinessDetail" => [
                    "statecode" => "0",
                    "ilu_campus" => "MDE",
                    "statuscode" => "0",
                    "ilu_program" => $request->program,
                    "ilu_utmterm" => "organico",
                    "modalidad" => $request->ilu_opportunitytype,
                    "ilu_utmmedium" => "organico",
                    "ilu_utmsource" => "organico",
                    "ilu_utmcontent" => "organico",
                    "ilu_programtype" => "PROF-PRE",
                    "ilu_utmcampaing" => "organico",
                    "ilu_id_formulario" => "btl-campaing-001",
                    "ilu_origen_automatico" => " OL-5580"
                ]
            ],
            "urlReferer" => "https://poli.edu.co",
            "dataTypeCode" => "LEAD"
        ]);

        $res = $response->json();

        if ($res['success']) {
            return redirect('/')->with('success', 'Lead enviado correctamente.');
        }
    }
}
