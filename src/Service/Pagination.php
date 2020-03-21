<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

class Pagination {
  private $entityClass;
  private $limit = 10;
  private $currentPage = 1;
  private $manager;
  private $twig;
  private $route; 
  private $templatePath;

  public function __construct(EntityManagerInterface $manager, Environment $twig, RequestStack $request, $templatePath) {
    //  returns error as this service can not be injected here php bin/console debug:container
    // dd($request);
    // php bin/console debug:container request
    //  dd($request);
    $this->route = $request->getCurrentRequest()->attributes->get('_route');
    // dd($this->route);
    $this->manager = $manager;
    $this->twig = $twig;
    $this->templatePath = $templatePath;

    return $this;
  }

  public function setTemplatePath($templatePath) {
    $this->templatePath = $templatePath;
    return $this;
  }

  public function getTemplatePath() {
    return $this->templatePath;
  }

  public function setRoutes($route) {
    $this->route = $route;
    return $this;
  }
  public function getRoute () {
    return $this->route;
  }

  public function display () {
    $this->twig->display($this->templatePath, [
        'page' => $this->currentPage,
        'pages' => $this->getPages(),
        'route' => $this->route
    ]);
  }

  public function getPages() {
    if(empty($this->entityClass)) {
      throw new \Exception("No specified entity on which paginate, give one in using setEntityClass().");
    }
    $repo = $this->manager->getRepository($this->entityClass);
    $total = count($repo->findAll());
    $pages = ceil($total / $this->limit);
    return $pages;

  }

  public function getData() {
    if(empty($this->entityClass)) {
      throw new \Exception("No specified entity on which paginate, give one in using setEntityClass().");
    }
    $offset = $this->currentPage * $this->limit - $this->limit;
    $repo = $this->manager->getRepository($this->entityClass);
    $data = $repo->findBy([],[], $this->limit, $offset);

    return $data;
  }

  public function setEntityClass($entityClass) {
    $this->entityClass = $entityClass;

    return $this;
  }

  public function getEntityClass() {
    return $this->entityClass;
  }

  public function setLimit($limit) {
    $this->limit = $limit;

    return $this;
  }

  public function getLimit() {
    return $this->limit;
  }

  public function setPage($currentPage) {
    $this->currentPage = $currentPage;

    return $this;
  }

  public function getPage() {
    return $this->currentPage;
  }
}