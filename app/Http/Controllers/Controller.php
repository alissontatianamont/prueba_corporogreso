<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function uploadExcel(Request $request) {
        $request->validate([
            'archivo_excel' => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('archivo_excel')->getRealPath();
        $data = Excel::toArray(new class {
                            
                        }, $path);

        $requiredHeaders = ['USERNAME', 'EMAIL', 'PASSWORD'];
        $filteredData = [];

        if (!empty($data) && !empty($data[0])) {
            $headers = $data[0][0];
            if (array_intersect($requiredHeaders, $headers) == $requiredHeaders) {
                for ($i = 1; $i < count($data[0]); $i++) {
                    $username = $data[0][$i][array_search('USERNAME', $headers)] ?? null;
                    $email = $data[0][$i][array_search('EMAIL', $headers)] ?? null;
                    $password = $data[0][$i][array_search('PASSWORD', $headers)] ?? null;

                    // Solo añade la fila si todas las columnas tienen valores
                    if ($username && $email && $password) {
                        $filteredData[] = [
                            'USERNAME' => $username,
                            'EMAIL' => $email,
                            'PASSWORD' => $password
                        ];
                    }
                }
            }else{
                $error = "el archivo no cuenta con el formato interno correcto, por favor use la plantilla";
                    return view('welcome', ['error_msg' => $error]);
            }
        }
        return $this->createUsers($filteredData, $filteredData);

    }

    public function createUsers($usuarios, $filteredData) {
        $usuariosCreados = 0;
        $errors = []; // Un array para almacenar los errores
        $fila = 2;
        $min_password = 3;
        $min_name = 3;

        // VALIDACIONES
        foreach ($usuarios as $usuario) {
            $nombre = $usuario["USERNAME"];
            $email = $usuario["EMAIL"];
            $password = $usuario["PASSWORD"];

            if ($nombre !== null && $email !== null && $password !== null) {
                if (strlen($nombre) < $min_name) {
                    $errors[] = "Fila No. " . $fila . " El nombre de usuario debe tener al menos $min_name caracteres.";
                }

                // Validación del email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Fila No. " . $fila . " El formato del correo electrónico no es válido para: $email ";
                }

                // Validación de la contraseña
                if (strlen($password) < $min_password) {
                    $errors[] = "Fila No. " . $fila . " La contraseña debe tener al menos $min_password caracteres.";
                }

                $user = User::where('email', $email)->first();
                if ($user !== null) {
                    $errors[] = "Fila No. " . $fila . " email repetido";
                }

                if (empty($errors)) {
                    $user = new User();
                    $user->name = $nombre;
                    $user->email = $email;
                    $user->password = bcrypt($password);
                    $user->save();
                    $usuariosCreados++;
                }
            }
            $fila++;
        }

        if (!empty($errors)) {
            return view('welcome')->with(['errors' => $errors, 'data' => $filteredData]);
        } else {
            return view('welcome')->with(['usuariosCreados' => $usuariosCreados, 'data' => $filteredData]);
        }
    }

}
