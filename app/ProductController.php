<?php

class ProductController {

    public function getProductDetails($slug) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://crud.jonathansoto.mx/api/products/$slug",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['635|dpQ8rIYnu4zuYBZB71sBeAhBrEtTuTZe8M4SGYjQ'],
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $productData = json_decode($response, true);

        return $productData['data'] ?? null;
    }

    public function getBrands() {
        $token = $_SESSION['635|dpQ8rIYnu4zuYBZB71sBeAhBrEtTuTZe8M4SGYjQ'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands', // URL de la API de marcas
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $error = curl_errno($curl);
        curl_close($curl);

        if ($error) {
            return [];
        }

        $brandsData = json_decode($response, true);

        return $brandsData['data'] ?? [];
    }

    public function createProduct($name, $description, $price, $brand_id) {
        if ($_POST['global_token'] !== $_SESSION['global_token']) {
            die("Acceso denegado: token no válido.");
        }
    
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query(array(
                'name' => $name,
                'description' => $description,
                'price' => $price,
            )),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));
    
        $response = curl_exec($curl);
        $error = curl_errno($curl);
        curl_close($curl);
    
        return !$error && $response;
    }

    public function updateProduct($id, $name, $description, $price) {
        $token = $_SESSION['635|dpQ8rIYnu4zuYBZB71sBeAhBrEtTuTZe8M4SGYjQ'];
    
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => http_build_query(array(
                'name' => $name,
                'description' => $description,
                'price' => $price,
            )),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));
    
        $response = curl_exec($curl);
        $error = curl_errno($curl);
        curl_close($curl);
    
        return !$error && $response;
    }

    public function deleteProduct($productId) {
        $token = $_SESSION['635|dpQ8rIYnu4zuYBZB71sBeAhBrEtTuTZe8M4SGYjQ'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $productId,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        $error = curl_errno($curl);
        curl_close($curl);

        return !$error && json_decode($response, true)['success'] ?? false;
    }
}

?>
