<?php 

namespace App\Services;

use App\Traits\ConsumesExternalServices;


class ZoomService 
{
    use ConsumesExternalServices;

    protected $apiKey;

    protected $apiSecret;

    protected $baseUri;

    protected $jwtToken;

    public function __construct()
    {
        $this->apiKey    = config('services.zoom.api_key');
        $this->apiSecret = config('services.zoom.api_secret');   
        $this->baseUri   = config('services.zoom.base_uri');   
        $this->jwtToken  = config('services.zoom.jwt_token'); 
    }

    public function resolveAuthorization(&$queryParams , &$formParams , &$headers)
    {
        $headers['Content-Type'] = "application/json";
        $headers['authorization'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        return "Bearer " . $this->jwtToken;
    }

    public function handle_create_online_class($request)
    {
        $teacher = auth()->guard('teacher')->user();

        $data = [
            'topic'          => $request->topic,
            'start_time'       => $request->start_time,
            'duration'       => $request->duration,
            'user_id'        => $request->teacher_id,
            'contact_email'  => $teacher->email,
            'contact_name'   => $teacher->name,

        ];

        $meeting = $this->create_meeting($data);
        
        return $meeting;
    }

    public function create_meeting($data)
    {
        $method = "POST";
        $url    = "/v2/users/me/meetings";
      
        $query_parameters = [];
        $form_parameters = [
          'duration'   => $data['duration'],
          'start_time' => $data['start_time'],
          'timezone'   => 'Africa/Cairo',
          'topic'      => $data['topic'],
          'type'       => 2,   //for schedule meeting
          'settings'   => [
              'auto_recording' => 'local',
              'contact_email'  => $data['contact_email'],
              'contact_name'   => $data['contact_name'],
          ],

        ];
        $headers = [];
        $is_json = true;

        $json = $this->makeRequest($method , $url , $query_parameters , $form_parameters , $headers , $is_json);

        return $json;

    }

    public function get_user()
    {
        $method = "GET";
        $url    = "/v2/users/me";
      
        $query_parameters = [];
        $form_parameters = [];
        $headers = [];
        $is_json = true;

        $json = $this->makeRequest($method , $url , $query_parameters , $form_parameters , $headers , $is_json);

        return $json;

    }
}