<?php
abstract class GlobalController
{

    public static function addImage($fileImage, $nomImage)
    { //Retourne vrai si l'image s'est ajoutée; Faux sinon;
        if (!empty($fileImage["name"])) {
            $info = pathinfo($fileImage['name']);
            $problem = false;
            // var_dump($fileImage);
            // exit;
            if (($fileImage['size'] > 1000000) || ($fileImage['size'] == 0)) {
                $problem = true;
                GlobalController::setEchec("Problème lors de l'envoie du fichier : trop volumineux !");
            }
            if (($info['extension'] != "jpg") && ($info['extension'] != "png") && ($info['extension'] != "jpeg")) {
                $problem = true;
                GlobalController::setEchec("Problème lors de l'envoie du fichier : mauvaise extension !");
            }
            if (!$problem) {
                move_uploaded_file($fileImage['tmp_name'], "public/images/" . $nomImage);
                //move_uploaded_file($fileImage['tmp_name'], "public/images/".$nomImage.".".$info['extension']);
                return true;
            }
        } else {
            GlobalController::setEchec("Problème lors de l'envoie du fichier !");
            return false;
        }
    }

    public static function setSucces($message)
    {
        if (empty($_SESSION["succes"])) {
            $_SESSION["succes"] = $message;
        } else {
            $_SESSION["succes"] .= $message;
        }
    }

    public static function setEchec($message)
    {
        if (empty($_SESSION["echec"])) {
            $_SESSION["echec"] = $message;
        } else {
            $_SESSION["echec"] .= $message;
        }
    }

    public static function afficheSucces()
    {
        if (!empty($_SESSION["succes"])) {
            echo '
                    <div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>' .
                $_SESSION["succes"]
                . '</div>
                ';
        }
        unset($_SESSION["succes"]);
    }

    public static function afficheEchec()
    {
        if (!empty($_SESSION["echec"])) {
            echo '
                    <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>' .
                $_SESSION["echec"]
                . '</div>
                ';
        }
        unset($_SESSION["echec"]);
    }
}
