<?php

require_once "src/Helpers/IConstants.php";
require_once "src/Starship.php";
require_once "src/Helpers/Helper.php";

use src\Helpers\Helper;
use src\Starship;

// Fetch starship data from SWAPI API
$response = Helper::curlAPI(Helper::API_URL);
$data = json_decode($response, true);

if (!empty($data['results'])) {
    $starships = $data['results'];

    $starshipObjects = [];

    foreach ($starships as $starship) {
        $pilots = [];

        foreach ($starship['pilots'] as $pilotUrl) {
            $pilotData = json_decode(Helper::curlAPI($pilotUrl), true);
            $pilots[] = [
                'name' => $pilotData['name'],
                'height' => $pilotData['height']
            ];
        }

        $starshipObjects[] = new Starship(
            $starship['name'],
            $starship['model'],
            $starship['cargo_capacity'],
            (int)$starship['max_atmosphering_speed'],
            $starship['crew'],
            $pilots
        );
    }

// Sort Starships by fastest (descending order)
    usort($starshipObjects, function ($a, $b) {
        return $b->getSpeed() - $a->getSpeed();
    });

// Display the Starships
    echo "<table>
        <tr>
            <th>Name</th>
            <th>Model</th>
            <th>Cargo Capacity</th>
            <th>Pilots</th>
            <th>Crew Size</th>
            <th>Speed Difference</th>
        </tr>";

    $fastestStarship = $starshipObjects[0]->getSpeed();

    foreach ($starshipObjects as $starship) {
        $speedDifference = abs(round(($starship->getSpeed() - $fastestStarship) / $fastestStarship * 100));

        echo "<tr>
            <td>{$starship->getName()}</td>
            <td>{$starship->getModel()}</td>
            <td>{$starship->getCargoCapacity()}</td>
            <td>";

        if (!empty($starship->getPilots())) {
            foreach ($starship->getPilots() as $pilot) {
                echo "{$pilot['name']} (Height: {$pilot['height']})<br>";
            }
        } else {
            echo "Unknown";
        }

        echo "</td>
            <td>{$starship->getCrewSize()}</td>
            <td>{$speedDifference}% slower</td>
          </tr>";
    }

    echo "</table>";
} else {
    echo Helper::NOT_FOUND;
    die();
}
