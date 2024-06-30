<?php


class PageController extends AbstractController
                {
                    public function about() : void
                    {
                     $this->render("main/about.html.twig", []);
                    }
                    public function legal() : void
                    {
                     $this->render("main/legal.html.twig", []);
                    }
                    
                    // Method to display the home page             
                    public function home() : void
                    {
                        $this->render("home.html.twig" , []);
                    }
                }