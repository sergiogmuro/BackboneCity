<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;

class ApiController extends Controller
{
    const FILENAME = 'CPdescarga.txt';

    public function index($id)
    {
        return response()->json($this->find($id));
    }

    /**
     * Process file
     *
     * @param $id
     * @return array
     */
    private function find($id): array
    {
        $settlements = [];

        $lines = file(config_path(self::FILENAME));
        foreach ($lines as $line) {
            if (strpos($line, $id) === 0) {
                $data = explode('|', $line);
                $settlements[] = $data;
            }
        }

        if (empty($data)) {
            abort(404);
        }
        
        return $this->mapData($settlements);
    }

    /**
     * Process mapping data
     *
     * @param $data
     * @return array
     */
    private function mapData($data): array
    {
        $settlements = [];
        foreach ($data as $settlement) {
            $settlements[] = [
                "key" => (int)$settlement[12],
                "name" => Helpers::formatString($settlement[1]),
                "zone_type" => Helpers::formatString($settlement[13]),
                "settlement_type" => [
                    "name" => ($settlement[2])
                ]
            ];
        }

        return [
            "zip_code" => $data[0][0],
            "locality" => Helpers::formatString($data[0][4]),
            "federal_entity" => [
                "key" => (int)$data[0][7],
                "name" => Helpers::formatString($data[0][5]),
                "code" => null
            ],
            "settlements" => $settlements,
            "municipality" => [
                "key" => (int)$data[0][11],
                "name" => Helpers::formatString($data[0][3])
            ]
        ];
    }
}
