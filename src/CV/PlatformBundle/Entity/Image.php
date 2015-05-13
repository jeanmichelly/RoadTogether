<?php
namespace CV\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="cv_image")
 * @ORM\Entity(repositoryClass="CV\PlatformBundle\Entity\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
  /**
   * @ORM\Column(name="url", type="string", length=255)
   */
  private $url;

  /**
   * @ORM\Column(name="alt", type="string", length=255)
   */
  private $alt;

  /**
   * @Assert\File(
   * maxSizeMessage = "L’image ne doit pas dépasser 5Mb.",
   * maxSize = "5000k",
   * mimeTypes = {"image/jpg", "image/jpeg", "image/gif", "image/png"},
   * mimeTypesMessage = "Les images doivent être au format JPG, GIF ou PNG."
   *)
   */
  private $file;
  private $tempFilename;

  public function getWebPath()
  {
    return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
  }

  public function setFile(UploadedFile $file)
  {
    $this->file = $file;

    if (null !== $this->url) {

      $this->tempFilename = $this->url;

      $this->url = null;
      $this->alt = null;
    }
  }

  /**
   * @ORM\PrePersist()
   * @ORM\PreUpdate()
   */
  public function preUpload()
  {
    if (null === $this->file) {
      return;
    }

    $this->url = $this->file->guessExtension();
    $this->alt = $this->file->getClientOriginalName();
  }

  /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */
  public function upload()
  {
    if (null === $this->file) {
      return;
    }

    if (null !== $this->tempFilename) {
      $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
      
      if (file_exists($oldFile)) {
        unlink($oldFile);
      }
    }

    $this->file->move(
      $this->getUploadRootDir(), 
      $this->id.'.'.$this->url  
      );
  }

  /**
   * @ORM\PreRemove()
   */
  public function preRemoveUpload()
  {
    $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
  }

  /**
   * @ORM\PostRemove()
   */
  public function removeUpload()
  {
    if (file_exists($this->tempFilename)) {

      unlink($this->tempFilename);
    }
  }

  public function getUploadDir()
  {
    return 'uploads/img';
  }

  protected function getUploadRootDir()
  {
    return __DIR__.'/../../../../web/'.$this->getUploadDir();
  }

  /**
   * Get id
   *
   * @return integer 
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set url
   *
   * @param string $url
   * @return Image
   */
  public function setUrl($url)
  {
    $this->url = $url;

    return $this;
  }

  /**
   * Get url
   * 
   * @return string 
   */
  public function getUrl()
  {
    return $this->url;
  }

  /**
   * Set alt
   *
   * @param string $alt
   * @return Image
   */
  public function setAlt($alt)
  {
    $this->alt = $alt;
    return $this;
  }

  /**
   * Get alt
   *
   * @return string 
   */
  public function getAlt()
  {
    return $this->alt;
  }

  /**
   * Get file
   *
   * @return string 
   */
  public function getFile()
  {
    return $this->file;
  }

  /**
   * Set tempFilename
   *
   * @param string $tempFilename
   * @return Image
   */
  public function setTempFilename($tempFilename)
  {
    $this->tempFilename = $tempFilename;
    return $this;
  }

  /**
   * Get tempFilename
   * 
   * @return string 
   */
  public function getTempFilename()
  {
   return $this->tempFilename;
 }
}
