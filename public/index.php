<?php

    require_once __DIR__ . "/../includes/app.php";

    use MVC\Router;
    use Controllers\PropertyController;
    use Controllers\AgentController;
    use Controllers\EntryController;
    use Controllers\SitesController;
    use Controllers\LoginController;

    $router = new Router();

    // Private Zone

    $router->get("/admin", [PropertyController::class, "index"]);
    $router->get("/properties/create", [PropertyController::class, "create"]);
    $router->post("/properties/create", [PropertyController::class, "create"]);
    $router->get("/properties/update", [PropertyController::class, "update"]);
    $router->post("/properties/update", [PropertyController::class, "update"]);
    $router->post("/properties/delete", [PropertyController::class, "delete"]);
    
    $router->get("/agents/create", [AgentController::class, "create"]);
    $router->post("/agents/create", [AgentController::class, "create"]);
    $router->get("/agents/update", [AgentController::class, "update"]);
    $router->post("/agents/update", [AgentController::class, "update"]);
    $router->post("/agents/delete", [AgentController::class, "delete"]);

    $router->get("/entries/create", [EntryController::class, "create"]);
    $router->post("/entries/create", [EntryController::class, "create"]);
    $router->get("/entries/update", [EntryController::class, "update"]);
    $router->post("/entries/update", [EntryController::class, "update"]);
    $router->post("/entries/delete", [EntryController::class, "delete"]);

    // Public Zone

    $router->get("/", [SitesController::class, "index"]);
    $router->get("/about-us", [SitesController::class, "aboutus"]);
    $router->get("/properties", [SitesController::class, "properties"]);
    $router->get("/property", [SitesController::class, "property"]);
    $router->get("/blog", [SitesController::class, "blog"]);
    $router->get("/entry", [SitesController::class, "entry"]);
    $router->get("/contact", [SitesController::class, "contact"]);
    $router->post("/contact", [SitesController::class, "contact"]);

    // Login and Authentication

    $router->get("/login", [LoginController::class, "login"]);
    $router->post("/login", [LoginController::class, "login"]);
    $router->get("/logout", [LoginController::class, "logout"]);

    $router->verifyRoutes();