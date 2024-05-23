<?php

class AdminController extends AbstractController
                {   
                    public function AdminAvis() : void 
                    {
                        $avis = new AvisManager;
                        
                        $aviss = $avis->findAll();
                        
                        
                       $this->render("admin/admin-avis/admin-avis.html.twig", [
                           "aviss" => $aviss
                       ]);
                    }
                    
                    public function AdminReservation() : void 
                    {
                       $reservation = new ReservationManager;
                        
                        $reservations = $reservation->findAll();
                        
                        
                       $this->render("admin/admin-reservation/admin-reservation.html.twig", [
                           "reservations" => $reservations
                       ]); 
                    } 
                    
                    public function AdminMenu() : void
                    {
                        $menu = new MenuManager;
                        
                        $menus = $menu->findAll();
                        //dump ($menus);
                        
                       $this->render("admin/admin-menu/admin-menu.html.twig", [
                           "menus" => $menus
                       ]);
                    } 
                    
                    public function AdminEdit() : void
                    {
                        $user = new UserManager;
                        
                        $users = $user->findAll();
                        
                        
                       $this->render("admin/edit-admin.html.twig", [
                           "users" => $users
                       ]);
                    } 
                }