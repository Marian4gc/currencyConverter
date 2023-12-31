<?php

namespace App\Controller;

use App\Form\FormType;
use App\Service\CurrencyConverterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

class CurrencyConverterController extends AbstractController
{
    private $currencyConverterService;

    public function __construct(CurrencyConverterService $currencyConverterService)
    {
        $this->currencyConverterService = $currencyConverterService;
    }

    #[Route('/currency/converter', name: 'app_currency_converter')]
    public function index(Request $request): Response
    {
        $currencies = $this->currencyConverterService->getCurrencies();

        $form = $this->createForm(FormType::class, null, [
            'currencies' => $currencies,
        ]);
        $form->handleRequest($request);

        $result = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $result = $this->currencyConverterService->convertCurrency($data['amount'], $data['currencyFrom'], $data['currencyTo']);
        }

        return $this->render('currency_converter/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }

    #[Route('/api/convert', name: 'api_currency_converter', methods: ['POST'])]
    public function convertApi(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            if (!$data || empty($data['amount']) || empty($data['currencyFrom']) || empty($data['currencyTo'])) {
                throw new \Exception('Please enter an amount.', 400);
            }

            if (!is_numeric($data['amount'])) {
                throw new \Exception('Please enter a valid numeric amount without letters or symbols.', 400);
            }

            $result = $this->currencyConverterService->convertCurrency($data['amount'], $data['currencyFrom'], $data['currencyTo']);

            if ($result === null) {
                throw new \Exception('Failed to convert currency.', 500);
            }

            return new JsonResponse(['convertedAmount' => $result]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
        }
    }

    #[Route('/api/currencies', name: 'api_currencies')]
    public function getCurrenciesApi(): JsonResponse
    {
        $currencies = $this->currencyConverterService->getCurrencies();

        return new JsonResponse(['currencies' => $currencies]);
    }
}

