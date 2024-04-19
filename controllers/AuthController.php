<?php


class AuthController extends AbstractController
                {
                    public function reserver() : void
                    {
                     $this->render("main/reserver.html.twig", []);
                    }
                    
                    public function avis() : void
                    {
                     $this->render("main/avis.html.twig", []);
                    }
                    public function connexion() : void
                    {
                      $this->render("main/connexion.html.twig", []);
                    }
                     
                }