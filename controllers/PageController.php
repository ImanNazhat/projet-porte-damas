<?php


class PageController extends AbstractController
                {
                    public function about() : void
                    {
                     $this->render("main/about.html.twig", []);
                    }
                    
                    public function menu() : void
                    {
                     $this->render("main/menu.html.twig", []);
                    }
                }