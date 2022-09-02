<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Payment;
use App\Form\PaymentType;
use App\Repository\OrderProductRepository;
use App\Repository\OrderRepository;
use App\Repository\PaymentRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/order', name: 'order_')]
class OrderController extends AbstractController
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly ProductRepository $productRepository,
        private readonly OrderProductRepository $orderProductRepository,
        private readonly PaymentRepository $paymentRepository,
    ){}

    #[Route('/new', name: 'new', methods: ['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $manager): JsonResponse
    {
        $user = $this->getUser();
        $order = new Order();
        $order->setStatus("En cours");
        $order->setUserbis($user);
        $order->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($order);
        $manager->flush();

        $basket = $request->request->get("order");
        $basket = (array)json_decode($basket);

        $basket = array_map(function($basketItem){
            return((array)$basketItem);
        },$basket);

        foreach ($basket as $productline)
        {
            $price = floatval($productline["price"]);
            $quantity = intval($productline["quantity"]);

            $orderProduct = new OrderProduct();

            $orderProduct->setProduct($this->productRepository->findOneBy(['id' => $productline["id"]]));
            $orderProduct->setQuantity($quantity);
            $orderProduct->setPriceEach($price);
            $orderProduct->setSubtotal($price*$quantity);
            $orderProduct->setOrderbis($order);

            $manager->persist($orderProduct);
            $manager->flush();

            $order->addOrderProduct($orderProduct);
        }

        return  $this->json($order,200, [],['groups' => 'order:read']);

    }
    #[Route('/payement/{id}', name: 'payement', methods: ['GET', 'POST'])]
    public function payment(Order $order, Request $request): Response
    {

        $form = $this->createForm(PaymentType::class);

        return $this->renderForm('payment/new.html.twig', [
            'form' => $form,
            'orderId' => $order->getId(),
        ]);

    }

    #[Route('/fetch-payment', name: 'fetch_payment', methods: ['GET', 'POST'])]
    public function fetchPayment(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        $content = (array)json_decode($request->getContent());

        $order = $this->orderRepository->find($content["orderId"]);

        $products = $order->getOrderProducts();
        $total = 0;
        for ($i = 0; $i < count($products); $i++) {
            /** @var OrderProduct $products */
            $product = $products[$i];
            $total += $product->getSubtotal();
        }
        $payment = new Payment();
        $payment->setCreatedAt(new \DateTimeImmutable());
        $payment->setType($content["paymentType"]);
        $payment->setOrderbis($order);
        $payment->setUserbis($user);
        $payment->setAmount($total);

        $this->paymentRepository->add($payment, true);

        $order->setStatus("Finish");

        $this->orderRepository->add($order);

        if(!$payment->getId()){

            return $this->json("error",400);
        }

        return $this->json("payment-valide",200);

    }


}
