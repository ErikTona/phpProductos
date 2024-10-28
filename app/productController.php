<?php
class ProductController {
    private $apiUrl = 'https://crud.jonathansoto.mx/api/products';

    public function getProducts() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['635|dpQ8rIYnu4zuYBZB71sBeAhBrEtTuTZe8M4SGYjQ'], 
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response_data = json_decode($response, true);

        // Verificar si se obtuvo correctamente
        return $response_data['data'] ?? []; 
    }
}
?>
