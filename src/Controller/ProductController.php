<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constant\DirectoryConst;
use App\Constant\UserConst;
use App\Entity\Product;
use App\Entity\Stock;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Util\FilesUtil;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/product", name="product")
 */
class ProductController extends AbstractController
{
    private ProductRepository $productRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(ProductRepository $productRepository, EntityManagerInterface $entityManager)
    {
        $this->productRepository = $productRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="_index")
     *
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", statusCode=404, message="Access denied")
     */
    public function index(): Response
    {
        $products = $this->productRepository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/create", name="_create")
     *
     * @IsGranted(UserConst::ROLE_ADMIN)
     */
    public function create(Request $request): Response
    {
        $product = new Product();
        $stock = new Stock();

        $product->setStock($stock);
        $form = $this->createForm(ProductType::class, $product, [
            'productImages' => FilesUtil::getFiles(DirectoryConst::PRODUCT_IMAGES_DIRECTORY, DirectoryConst::IMAGES_FORMAT),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($stock);
            $this->entityManager->persist($product);
            $this->entityManager->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.product.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="_delete")
     *
     * @IsGranted(UserConst::ROLE_ADMIN)
     */
    public function delete(int $id): Response
    {
        $product = $this->productRepository->find($id);
        if (null === $product) {
            return $this->json(['error' => 'Product with provided id does not exist']);
        }

        $this->entityManager->remove($product->getStock());
        $this->entityManager->remove($product);
        $this->entityManager->flush();

        return $this->redirectToRoute('product_index');
    }
}
