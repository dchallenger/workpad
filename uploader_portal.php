<?php
        /**
        * Initialize the cURL session
        */
        $ch = curl_init();

        /**
        * Set the URL of the page or file to download.
        */
        curl_setopt($ch, CURLOPT_URL, 'http://10.0.1.67/emplopad/en/uploader_portal');

        /**
        * Ask cURL to return the contents in a variable
        * instead of simply echoing them to the browser.
        */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

        curl_setopt($ch, CURLOPT_TIMEOUT, 900);

        /**
        * Execute the cURL session
        */
        $contents = curl_exec ($ch);

        /**
        * Close cURL session
        */
        curl_close ($ch);

?>
