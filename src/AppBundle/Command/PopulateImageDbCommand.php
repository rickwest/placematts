<?php

namespace AppBundle\Command;

use AppBundle\Entity\Image;
use AppBundle\Helper\ImageDataHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class PopulateImageDbCommand extends ContainerAwareCommand {
    public function configure() {
        $this
            ->setName('app:populate-images')
            ->setDescription('Populates image database with image data.');
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        // Delete all existing rows from table
        $em = $this->getContainer()->get('doctrine')->getManager();
        $query = $em->createQuery(
            'DELETE FROM AppBundle:Image'
        );
        $query->execute();

        // Get images array from helper class and save to table
        foreach (ImageDataHelper::getImageData() as $data) {
            /** @var Image $image */
            $image = new Image();
            $image
                ->setFilename($data[0])
                ->setSubject($data[1])
                ->setPageUrl($data[2])
                ->setFileUrl($data[3])
                ->setAttribution($data[4])
            ;

            $em->persist($image);
            $em->flush();
        }
    }
}