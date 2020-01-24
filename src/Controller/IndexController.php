<?php

namespace App\Controller;

use App\JSONToReturn;
use App\Repository\UnitRepository;
use App\Service\UnitService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use function App\Service\kwToCo2;
use function App\Service\m2toHectare;


class IndexController extends AbstractController
{
    private $serializer;
    private $unitService;

    /**
     * @var UnitRepository
     */
    private $unitRepository;

    /**
     * VoteController constructor.
     * @param SerializerInterface $serializer
     * @param UnitService $unitService
     * @param UnitRepository $unitRepository
     */
    public function __construct(
        SerializerInterface $serializer,
        UnitService $unitService,
        UnitRepository $unitRepository)
    {
        $this->serializer = $serializer;
        $this->unitService = $unitService;
        $this->unitRepository = $unitRepository;
    }

    const ERROR_CODE = 400;

    /**
     * @Route("/convert", name="convert", methods={"POST"})
     * UserStory 1 : m² to hectare
     * @param Request $request
     * @return JsonResponse
     */
    public function convert(Request $request)
    {
        $myObject = new JSONToReturn("Unknown error");
        if ($content = $request->getContent()) {
            $decode = json_decode($content, true);
            if (isset($decode['inUnit']) && isset($decode['outUnit'])) {

                if ($decode['inUnit'] == 'm2' && $decode['outUnit'] == 'hectare') {

                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, self::ERROR_CODE);
                    } else {
                        $toReturn = m2toHectare($decode['valueToConvert']);
                    }
                }

                if ($decode ['inUnit'] == 'kW' && $decode['outUnit'] == 'kgCo2') {

                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, self::ERROR_CODE);
                    } else {
                        $toReturn = kwToCo2($decode['valueToConvert']);
                    }
                }
            } else {
                $myObject->result = ["message" => " sent inUnit or/and outUnit not found"];
                return new JsonResponse($myObject, self::ERROR_CODE);
            }
            if (isset($toReturn)) {
                $myObject->result = ['convertedValue' => $toReturn];
                return new JsonResponse($myObject);
            }

            return new JsonResponse($myObject, self::ERROR_CODE);
        }
    }

    /**
     * @Route("/filterunits", name="filterunits", methods={"GET"})
     * UserStory 1 : m² to hectare
     * @return JsonResponse
     */
    public function filterunits()
    {
        $myObject = new JSONToReturn([['inUnit' => 'm2', 'outUnit' => 'hectare'], ['inUnit' => 'kW', 'outUnit' => 'kgCo2']]);
        return new JsonResponse($myObject);
    }

    /**
     * @Route("/unit", name="unit", methods={"GET"})
     */
    public function showUnits()
    {
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getSource();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);

        $displayAllUnits = new JSONToReturn($this->unitService->displayUnits($this->unitRepository));

        return new JsonResponse($serializer->serialize($displayAllUnits, 'json'), Response::HTTP_OK, [], true);
    }
}








