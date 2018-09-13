<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=191, unique=true)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=100, unique=false, nullable=true)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="page_url", type="string", length=510, unique=false, nullable=true)
     */
    private $pageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="file_url", type="string", length=510, unique=false, nullable=true)
     */
    private $fileUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="attribution", type="string", length=510, unique=false, nullable=true)
     */
    private $attribution;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFilename(): string {
        return $this->filename;
    }

    /**
     * @param string $filename
     * @return Image
     */
    public function setFilename(string $filename): Image {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Image
     */
    public function setSubject(string $subject): Image {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getPageUrl(): string {
        return $this->pageUrl;
    }

    /**
     * @param string $pageUrl
     * @return Image
     */
    public function setPageUrl(string $pageUrl): Image {
        $this->pageUrl = $pageUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileUrl(): string {
        return $this->fileUrl;
    }

    /**
     * @param string $fileUrl
     * @return Image
     */
    public function setFileUrl(string $fileUrl): Image {
        $this->fileUrl = $fileUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getAttribution(): string {
        return $this->attribution;
    }

    /**
     * @param string $attribution
     * @return Image
     */
    public function setAttribution(string $attribution): Image {
        $this->attribution = $attribution;
        return $this;
    }
}

