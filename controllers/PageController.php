<?php


class PageController extends AbstractController
                {
                    public function about() : void
                    {
                     $this->render("about", []);
                    }
                    
                    public function menu() : void
                    {
                     $this->render("menu", []);
                    }
                }