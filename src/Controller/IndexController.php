<?php

namespace App\Controller;


use App\Entity\Unite;
use App\JSONToReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function App\Service\kwToCo2;
use function App\Service\m2toHectare;


class IndexController extends AbstractController
{
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
                        $toReturn =m2toHectare($decode['valueToConvert']);
                    }
                }

                if ($decode ['inUnit'] == 'kW' && $decode['outUnit'] == 'kgCo2') {

                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, self::ERROR_CODE);
                    } else {
                        $toReturn =kwToCo2($decode['valueToConvert']);
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
     * UserStory 1 : m² to hectare
     * @Route("/unit", name="unit", methods={"GET"})
     */
    public function showUnits()
    {
        $allData = $this
            ->getDoctrine()
            ->getRepository(Unite::class)
            ->findAll();

        if (!$allData) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
        $reponse =array();
        for ($i=0 ; $i<count($allData); $i++){
            array_push($reponse, ['unit'=> $allData[$i]->getSymbole(), 'definition'=>$allData[$i]->getDefinition(), 'source'=>$allData[$i]->getSourceId()]);
        }

        $myObject = new JSONToReturn($reponse);
        return new JsonResponse($myObject);
    }

}








