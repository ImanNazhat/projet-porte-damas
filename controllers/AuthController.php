<?php


class AuthController extends AbstractController
                {
                    public function reserver() : void
                    {
                     $this->render("reserver", []);
                    }
                    
                    public function avis() : void
                    {
                     $this->render("avis", []);
                    }
                    public function connexion() : void
                    {
                      $this->render("connexion", []);
                    }
                     
                }