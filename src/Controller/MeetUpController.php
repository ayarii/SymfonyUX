<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

final class MeetUpController extends AbstractController
{
    #[Route('/meet/up', name: 'app_meet_up')]
    public function index(): Response
    {
        return $this->render('meet_up/index.html.twig', [
            'controller_name' => 'MeetUpController',
        ]);
    }

    #[Route('/meetup', name: 'meet_up')]
    public function symfonyMeetUp()
    {
        return $this->render("meet_up/show.html.twig");
    }


    #[Route('/chart', name: 'chart')]
    public function chart(ChartBuilderInterface $chartBuilder): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        return $this->render('book/chart.html.twig', [
            'chart' => $chart,
        ]);
    }
}
