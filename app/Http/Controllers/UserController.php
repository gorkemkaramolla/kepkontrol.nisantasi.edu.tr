<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class UserController extends Controller
{
    public function getStudentInformation($university_id)
    {
        $url = "https://ats.nisantasi.edu.tr/nisantasi-help";
        $data = [
            "ogrenci_no" => $university_id,
            'name' => 'bilgi_getir'
        ];
        // Make the HTTP POST request
        $response = Http::asForm()->post($url, $data);

        // Access the form_bilgi key
        $formBilgi = (string) $response->json()['form_bilgi'];

        $crawler = new Crawler($formBilgi);

        $studentInfo = [
            'name' => $crawler->filter('.adsoyad')->attr('value'),
            'department' => $crawler->filter('.bolum')->attr('value'),
            'class' => $crawler->filter('.sinif')->attr('value'),
            'email' => $crawler->filter('.profil_eposta')->attr('value'),
        ];
        return $studentInfo;
    }
    public function login(Request $request)
    {
        $loginData = [
            'university_id' => $request->input('university_id'),
            'password' => $request->input('password'),
        ];
        $studentInfo = $this->getStudentInformation($loginData['university_id']);

        $departmentName = $studentInfo['department'];

        $url = "https://sanalkampus.nisantasi.edu.tr/?returnUrl=%2FHome%2FIndex";
        $data = [
            'Password' => $loginData["password"],
        ];
        $cookies = [
            "CookUserName" => $loginData["university_id"],
        ];

        $response = Http::withHeaders(['Cookie' => http_build_query($cookies, '', '; ')])->withoutRedirecting()->post($url, $data);
        $htmlContent = $response->body();

        $crawler = new Crawler($htmlContent);

        $linkHref = $crawler->filter('h2 a')->attr('href');

        $parsedUrl = parse_url($linkHref);
        $queryParams = [];
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        }

        // Get the token value
        $tokenFirst = isset($queryParams['token']) ? $queryParams['token'] : '';

        $url = "https://almsp-prod-api.almscloud.com/api/account/decryptoken";
        $token = $tokenFirst;

        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Accept-Language" => "tr-TR",
            "Access-Control-Allow-Origin" => "*",
            "Authorization" => "Bearer",
            "Cache-Control" => "no-cache",
            "Content-Type" => "application/json",
            "Pragma" => "no-cache",
        ])
            ->post($url, [
                "Token" => $token,
                "Host" => "sanalkampus.nisantasi.edu.tr",
                "Port" => "",
            ]);

        // Handle the response
        $status = $response->status();

        $content = $response->json();

        if ($status === 200) {
            // Output the response
            $parts = explode('.', $content["access_token"]);

            // Check if the second part exists before decoding it
            if (isset($parts[1])) {
                $decodedToken = json_decode(base64_decode($parts[1]), true);

                // Check if the fields exist before accessing them
                $name = isset($decodedToken['name']) ? $decodedToken['name'] : null;
                $familyName = isset($decodedToken['familyname']) ? $decodedToken['familyname'] : null;
                $emailAddress = isset($decodedToken['emailaddress']) ? $decodedToken['emailaddress'] : null;

                $respons = response()->json([
                    'success' => true, // Add success field
                    'name' => $name,
                    'lastname' => $familyName,
                    'email' => $emailAddress,
                    'department' => $departmentName,
                    "student_number" => $loginData['university_id'],
                ]);
                $content = $respons->getContent();
                $decodedData = json_decode($content, true);
                return $decodedData;
            } else {
                echo "Error decoding token";
            }
        } else {
            return response()->json([
                'success' => false, // Add success field
                'error' => 'Unauthorized',
                'message' => 'Invalid credentials',
            ], 401);
        }
    }
}
