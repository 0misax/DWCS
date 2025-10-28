<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class IterativasController extends BaseController
{



   /*Crea un script que en un campo de texto solicite una matriz de números bidimensional, la ordene y posteriormente muestre su contenido correctamente alineado.
    Los números se separarán con comas y el cambio de línea se marca con el carácter |.
    Todas las líneas de la matriz deben tener el mismo número de elementos.Ejemplo: 1,2,3|4,5,6|7,8,9 ==>*/

    public function iterativas3(array $input = [], array $errors = []): void
    {
        $data = array(
            'titulo' => 'Iterativas 3',
            'breadcrumb' => ['Inicio', 'Iterativas', 'Iterativas 3'],
            'errors' => $errors,
            'input' => $input
        );
        $this->view->showViews(
            array('templates/header.view.php', 'iterativas3.view.php', 'templates/footer.view.php'),
            $data
        );
    }

    public function doIterativas3(): void
    {
        $errors = $this->checkErrorsIterativas3($_POST);
        $input = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($errors !== []) {
            $this->iterativas3($input, $errors);
        } else {
            $input['resultado'] = $this->ordenarMatrizTextual($input['matriz']);
            $this->iterativas3($input);
        }
    }

    private function ordenarMatrizTextual(string $matrizT): array
    {
        $matriz = explode('|', $matrizT);
        $matrizTemporal = array();
        foreach ($matriz as $item) {
            $matrizTemporal[] = explode(',', $item);
        }
        $tamFila = count($matrizTemporal[0]);
        $matrizTemporal = array_merge(...$matrizTemporal);
        sort($matrizTemporal);
        $matrizOrdenada = [];
        $tmp = [];
        for ($i = 0; $i < count($matrizTemporal); $i++) {
            if ($i !== 0 && $i % $tamFila == 0) {
                $matrizOrdenada[] = $tmp;
                $tmp = [];
            }
            $tmp[] = $matrizTemporal[$i];
        }
        $matrizOrdenada[] = $tmp;
        return $matrizOrdenada;
    }

    private function checkErrorsIterativas3(array $data): array
    {
        $errors = array();
        if (empty($data['matriz'])) {
            $errors['matriz'] = 'Inserte una matriz';
        } else {
            $tmp = explode('|', $data['matriz']);
            $procesada = array();
            foreach ($tmp as $item) {
                $procesada[] = explode(',', $item);
            }
            //Comprobamos si son números todos los elementos de la matriz
            $noNumeros = [];
            foreach ($procesada as $lista) {
                foreach ($lista as $num) {
                    if (!is_numeric($num)) {
                        $noNumeros[] = $num;
                    }
                }
            }
            if ($noNumeros !== []) {
                $noNumeros = filter_var_array($noNumeros, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $errors['matriz'] = 'Los siguientes elementos no son números: ' . implode(', ', $noNumeros);
            } else {
                //Comprobamos si todas las filas de la matriz tienen el mismo tamaño
                $tamanoInicial = count($procesada[0]);
                $errorTamano = false;
                $i = 1;
                while ($i < count($procesada) && !$errorTamano) {
                    $errorTamano = count($procesada[$i]) !== $tamanoInicial;
                    $i++;
                }
                if ($errorTamano) {
                    $errors['matriz'] = 'Las filas no tienen el mismo tamaño';
                }
            }
        }
        return $errors;
    }




/*Crea un script que reciba unha cadena de texto e muestre por pantalla un listado con las letras y su uso ordenadas de
 más usadas a menos. El algoritmo no distingue mayúsculas de minúsculas por lo que una c será igual que una 'C'.
 No es necesario que aparezcan las letras no usadas en el texto. Para limpiar el texto puedes ayudarte de los contenidos
 expuestos en la subsección "Expresiones regulares" del aula virtual. Ejemplo: "Casa" mostraría. "a: 2, c: 1, s: 1".*/


    public function iterativas4(array $input = [], array $errors = [], array $resultado = []): void
    {
        $data = array(
            'titulo' => 'Iterativas 4',
            'breadcrumb' => ['Inicio', 'Iterativas', 'Iterativas 4'],
            'errors' => $errors,
            'input' => $input,
            'resultado' => $resultado
        );
        $this->view->showViews(
            array('templates/header.view.php', 'iterativas4.view.php', 'templates/footer.view.php'),
            $data
        );
    }

    public function doIterativas4(): void
    {
        $errors = $this->checkErrorsIterativas4($_POST);
        $input = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($errors !== []) {
            $this->iterativas4($input, $errors);
        } else {
            $texto = mb_strtolower(preg_replace('/\P{L}/u', '', $input['texto']));
            $textArray = mb_str_split($texto);
            $resultado = [];
            foreach ($textArray as $letra) {
                if (isset($resultado[$letra])) {
                    $resultado[$letra]++;
                } else {
                    $resultado[$letra] = 1;
                }
            }
            arsort($resultado);
            $this->iterativas4(input: $input, resultado: $resultado);
        }
    }

    private function checkErrorsIterativas4(array $data): array
    {
        $errors = array();
        if ($data['texto'] === '') {
            $errors['texto'] = 'Inserte un texto';
        } else {
            $texto = preg_replace('/\P{L}/u', '', $data['texto']);
            if ($texto === '') {
                $errors['texto'] = 'El texto no contiene letras';
            }
        }
        return $errors;
    }





    /*Crea un script que reciba una cadena de texto y muestre por pantalla una lista de las palabras existentes en ella
     ordenadas por número de apariciones.*/


    public function iterativas5(array $input = [], array $errors = [], array $resultado = []): void
    {
        $data = array(
            'titulo' => 'Iterativas 5',
            'breadcrumb' => ['Inicio', 'Iterativas', 'Iterativas 5'],
            'errors' => $errors,
            'input' => $input,
            'resultado' => $resultado
        );
        $this->view->showViews(
            array('templates/header.view.php', 'iterativas5.view.php', 'templates/footer.view.php'),
            $data
        );
    }

    public function doIterativas5(): void
    {
        $errors = $this->checkErrorsIterativas4($_POST);
        $input = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($errors !== []) {
            $this->iterativas5($input, $errors);
        } else {
            $texto = mb_strtolower(preg_replace('/\P{L}/u', ' ', $_POST['texto']));
            $textArray = preg_split('/\s+/', $texto);
            foreach ($textArray as $palabra) {
                if (isset($resultado[$palabra])) {
                    $resultado[$palabra]++;
                } else {
                    $resultado[$palabra] = 1;
                }
            }
            arsort($resultado);
            $this->iterativas5(input: $input, resultado: $resultado);
        }
    }

}
