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
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/{width}/{height}", name="image",
     * requirements={"width": "[0-9]+", "height": "[0-9]+"})
     */
    public function imageAction(Request $request, $width, $height) {

        /** @var Image $image */
        $image = $this->getDoctrine()
            ->getRepository(Image::class)
            ->findOneById(random_int(1, 4));

        if (!$image) {
            throw $this->createNotFoundException('No image found');
        }

        $file = new File(__DIR__ . '/../../../app/Resources/Images/' . $image->getFilename());

        $placeholder = (new ImageManager())
            ->make($file)
            ->fit($width, $height)
            ->greyscale()
            ->response('png');

        return new Response($placeholder, 200, [
            'Content-Type' => 'image/png'
        ]);
    }
}