<?php

    function connectDB() : mysqli {
        $db = new mysqli("localhost", "id21421183_root", "RealState_MVC23", "id21421183_realstate_mvc");

        if(!$db) {
            echo "It wasn't possible to connect to the Database";
            exit;
        };

        return $db;
    };