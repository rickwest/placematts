<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use Intervention\Image\ImageManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/images", name="images")
     */
    public function imagesAction(Request $request) {
        $images = $this->getDoctrine()
            ->getRepository(Image::class)
            ->findAll();

        $imageList = [];
        foreach ($images as $image) {
            $imageList[] = $image;
        }

        return $this->render('default/images.html.twig', ['images' => $imageList]);
    }

    /**
     * @Route("/{width}/{height}", name="image",
     * requirements={"width": "[0-9]+", "height": "[0-9]+"})
     * @param int $width
     * @param int $height
     * @param boolean $greyscale
     * @return Response
     */
    public function imageAction($width, $height, $greyscale = false) {
        /** @var Image $image */
        $images = $this->getDoctrine()
            ->getRepository(Image::class)
            ->findAll();

        if (!$images) {
            throw $this->createNotFoundException('No images found');
        }

        $image = $images[array_rand($images)];

        $file = new File(__DIR__ . '/../../../app/Resources/Images/Matts/' . $image->getFilename());

        $placeholder = (new ImageManager())->make($file);
        $placeholder->fit($width, $height);

        if ($greyscale) $placeholder->greyscale();

        $placeholder->response('png');

        return new Response($placeholder, 200, [
            'Content-Type' => 'image/png'
        ]);
    }

    /**
     * @Route("/g/{width}/{height}", name="greyscale",
     * requirements={"width": "[0-9]+", "height": "[0-9]+"})
     * @param $width
     * @param $height
     * @return Response
     */
    public function greyscaleAction($width, $height) {
        return $this->imageAction($width, $height, true);
    }
}