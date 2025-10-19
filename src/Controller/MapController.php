<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Map\Bridge\Leaflet\LeafletOptions;
use Symfony\UX\Map\Bridge\Leaflet\Option\TileLayer;
use Symfony\UX\Map\InfoWindow;
use Symfony\UX\Map\Map;
use Symfony\UX\Map\Marker;
use Symfony\UX\Map\Point;

class MapController extends AbstractController
{
    #[Route('/map', name: 'app_map')]
    public function __invoke(): Response
    {
        $map = (new Map('default'))
            ->center(new Point(45.7534031, 4.8295061))
            ->zoom(6)

            ->addMarker(new Marker(
                position: new Point(31.5000, 34.4667),
                title: 'Gaza',
                infoWindow: new InfoWindow(
                    content: '<p>Free Gaza!</p>',
                )
            ))
            ->options((new LeafletOptions())
                ->tileLayer(new TileLayer(
                    url: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    options: ['maxZoom' => 19]
                ))
            );

        return $this->render('map/map.html.twig', [
            'map' => $map,
        ]);
    }
}
