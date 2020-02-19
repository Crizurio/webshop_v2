<?php

namespace webshop_v2\Views;

use webshop_v2\Interfaces\iElements as iElements;

class HtmlPage extends HtmlView
{
    protected $stylesheets;
    protected $body_elements;
    
    protected function showOpenHeader() : bool
    {
        echo '<!DOCTYPE html>
              <html lan = "en>"
              <head>
              <meta charset = "utf-8">
              <meta name = "viewport content = "width-device-width,
              initial-scale = 1, shrink-to-fit=no">
              <script src = "https://code.jquery.com/jquery-3.4.1.min.js"
              integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
              crossorigin="anonymous"></script>';
        return true;
    }

    protected function showHeaderContent() : bool
    {
        if(!empty($this->stylesheets))
        {
            array_walk($this->stylesheets, function($stylesheet) {
                echo sprintf('<link rel = "stylesheet" type = "text/css"
                              href = "%s">', $stylesheet

                );
            });
        }

        if(!empty($this->java_scripts))
        {
            array_walk($this->java_scripts,
                function ($java_script)
                {
                    if($java_script !== '')
                    {
                        echo sprintf('<script src = "%s"></script>',
                            $java_script);
                    }
                });
        }

        return true;
    }

    protected function showCloseHeader() : bool
    {
        echo '</head>';
        return true;
    }

    protected function showOpenBody() : bool
    {
        echo '<body class="body">';
        return true;
    }

    protected function showBodyContent() : bool
    {
        $this->body_elements->show();
        return true;
    }

    protected function showCloseBody() : bool
    {
        echo '</body>
              </html>';
        return true;
    }
}